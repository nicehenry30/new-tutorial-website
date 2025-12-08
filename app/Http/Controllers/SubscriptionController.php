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
                'reference' => 'SUB_'.Str::upper(Str::random(10)),
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

    public function success(Request $request)
    {
        $reference = $request->query('reference');

        // Verify payment
        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->get("https://api.paystack.co/transaction/verify/{$reference}");

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

            return redirect()->route('user.dashboard')->with('success', 'Subscription successful!');
        }

        return redirect()->route('user.dashboard')->with('error', 'Payment verification failed.');
    }
}

