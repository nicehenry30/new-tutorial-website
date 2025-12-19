<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Signal;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SubscriptionController extends Controller
{
    public function pay_signal(Request $request, $signalId)
    {
        $signal = Signal::findOrFail($signalId);
        $plan = $request->plan;

        $amount = $plan === 'monthly' ? $signal->monthly_price : $signal->yearly_price;
        $amountInKobo = $amount * 100; // Paystack expects amount in kobo

        // Initialize Paystack payment
        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->post(env('PAYSTACK_PAYMENT_URL') . '/transaction/initialize', [
                'email' => auth()->user()->email,
                'amount' => $amountInKobo,
                'currency' => 'NGN',
                'reference' => 'SIGNAL_'.Str::upper(Str::random(10)),
                'callback_url' => route('subscribe.success'),
                'metadata' => [
                    'signal_id' => $signal->id,
                    'plan' => $plan,
                    'user_id' => auth()->id(),
                ],
            ]);

        $data = $response->json();

        if ($data['status']) {
            // Redirect user to Paystack checkout page
            return redirect($data['data']['authorization_url']);
        }

        return back()->with('error', 'Unable to initialize payment. Try again.');
    }

    public function success_signal(Request $request)
    {
        $reference = $request->query('reference');

        // Verify payment
        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->get(env('PAYSTACK_PAYMENT_URL') . '/transaction/verify/{$reference}');

        $data = $response->json();

        if ($data['status'] && $data['data']['status'] === 'success') {
            // Payment was successful, save subscription
            $meta = $data['data']['metadata'];
            Subscription::create([
                'category' => 'signal',
                'user_id' => $meta['user_id'],
                'signal_id' => $meta['signal_id'],
                'plan' => $meta['plan'],
                'amount' => $data['data']['amount'] / 100,
                'reference' => $reference,
                'status' => 'success',
            ]);

            // Add order in DB
            Order::create([
                "category" => "signal",
                "product_id" => $meta['signal_id'],
                "user_id" => Auth::id(),
                'email' => Auth::user()->email,
                'amount' => $data['data']['amount'] / 100,
                'reference' => $reference,
                'status' => 'paid',
            ]);

            return redirect()->route('user.dashboard')->with('success', 'Signal subscription successful!');
        }

        return redirect()->route('user.dashboard')->with('error', 'Payment verification failed.');
    }

    public function pay_bot(Request $request, $botId)
    {
        $bot = Bot::findOrFail($botId);
        $plan = $request->plan;

        $amount = $plan === 'monthly' ? $bot->monthly_price : $bot->yearly_price;

        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->post(env('PAYSTACK_PAYMENT_URL') . '/initialize', [
                "email" => auth()->user()->email,
                "amount" => $amount * 100,
                "reference" => "BOT_" . Str::upper(Str::random(12)),
                "callback_url" => route("bots.subscribe.success"),
                "metadata" => [
                    "bot_id" => $bot->id,
                    "user_id" => auth()->id(),
                    "plan" => $plan
                ]
            ]);

        $data = $response->json();

        if ($data["status"]) {
            return redirect($data["data"]["authorization_url"]);
        }

        return back()->with("error", "Unable to initialize payment.");
    }


    public function success_bot(Request $request)
    {
        $reference = $request->reference;

        $response = Http::withToken(env("PAYSTACK_SECRET_KEY"))
            ->get(env('PAYSTACK_PAYMENT_URL') . '/transaction/verify/$reference')
            ->json();

        if ($response["data"]["status"] === "success") {

            $meta = $response["data"]["metadata"];

            Subscription::create([
                'category' => 'bot',
                "user_id" => $meta["user_id"],
                "bot_id" => $meta["bot_id"],
                "plan" => $meta["plan"],
                "amount" => $response["data"]["amount"] / 100,
                "reference" => $reference,
                'status' => 'success',
            ]);

            // Add order in DB
            Order::create([
                "category" => "bot",
                "product_id" => $meta['bot_id'],
                "user_id" => Auth::id(),
                'email' => Auth::user()->email,
                'amount' => $data['data']['amount'] / 100,
                'reference' => $reference,
                'status' => 'paid',
            ]);

            return redirect()->route("user.dashboard")->with("success", "Bot subscription successful!");
        }

        return redirect()->route("user.dashboard")->with("error", "Payment verification failed.");
    }
}

