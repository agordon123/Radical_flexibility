<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Http\Controllers\Controller;

class PaymentLinkController extends Controller
{
    public function __invoke(Request $request)
    {
        // Set the Stripe API key
        Stripe::setApiKey(config('services.stripe.secret'));
        $validatedData  = $request->validateWithBag('order', [
            'payment_intent_id' => ['required', 'unique:string', 'max:255'],
            'painting_id' => ['required'],
            'amount' => ['required']
        ]);
        if ($validatedData) {
            $amount = $request->input('amount');
            $currency = $request->input('currency');

            // Create a new payment link
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => $currency,
                            'unit_amount' => $amount,
                            'product_data' => [
                                'name' => 'Your Product',
                            ],
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => env('APP_URL') || '/success',
                'cancel_url' => 'https://example.com/cancel',
            ]);
        }
        // Get the amount and currency from the request


        // Return the payment link URL to the client
        return response()->json(['url' => $session->url]);
    }
}
