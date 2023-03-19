<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Exception\CardException;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Payment;


class PaymentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string',
            'payment_type' => 'required|string',
        ]);

        // Set the Stripe API key
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Create a Payment Intent with Stripe
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount,
                'currency' => $request->currency,
                'metadata' => [
                    'payment_type' => $request->payment_type,
                ],
            ]);

            // Create a Payment record in the database
            Payment::create([
                'user_id' => $request->user()->id,
                'payment_intent_id' => $paymentIntent->id,
                'amount' => $paymentIntent->amount / 100,
                'currency' => $paymentIntent->currency,
                'payment_type' => $request->payment_type,
                'description' => 'Payment made via Stripe',
            ]);

            // Return the client secret for the Payment Intent
            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
            ]);
        } catch (CardException $e) {
            // Handle any errors returned by Stripe
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
