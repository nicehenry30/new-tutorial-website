<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        return view('checkout');
    }

    public function initiatePayment(Request $request)
    {
        // example amount: ₦500 => convert to kobo
        $amount = $request->amount * 100;

        $reference = Str::uuid(); // unique reference

        // CALL PAYSTACK INITIALIZE ENDPOINT
        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->post(env('PAYSTACK_PAYMENT_URL') . '/transaction/initialize', [
                'email' => $request->email,
                'amount' => $amount,
                'reference' => $reference,
                'callback_url' => url('/user/payment/callback'),
                'metadata' => [
                    'product_id' => $request->product_id,
                    "user_id" => Auth::id()
                ],
            ]);

        $res = $response->json();

        if (!$res['status']) {
            return back()->with('error', 'Unable to initiate payment.');
        }

        // Add order in DB
        Order::create([
            "category" => "course",
            "product_id" => $request->product_id,
            "user_id" => Auth::id(),
            'email' => $request->email,
            'amount' => $amount / 100,
            'reference' => $reference,
        ]);

        // Redirect user to Paystack payment page
        return redirect($res['data']['authorization_url']);
    }

    public function handleCallback(Request $request)
    {
        $reference = $request->reference;

        // VERIFY PAYMENT
        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->get(env('PAYSTACK_PAYMENT_URL') . "/transaction/verify/{$reference}");

        $res = $response->json();

        if ($res['status'] && $res['data']['status'] == 'success') {

            // UPDATE ORDER AS PAID
            Order::where('reference', $reference)->update(['status' => 'paid']);

            return redirect()->route('user.dashboard')->with('success', 'Payment successful');
        }

        // UPDATE ORDER STATUS
        Order::where('reference', $reference)->update(['status' => $res['data']['status']]);

        return redirect()->route('user.index')->with('error', 'Payment failed or invalid');
    }
}
