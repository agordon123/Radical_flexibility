<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Payment;
use App\Models\Painting;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Stripe\Exception\CardException;


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
            $payment = Payment::create([
                'user_id' => $request->user()->id,
                'payment_intent_id' => $paymentIntent->id,
                'amount' => $paymentIntent->amount / 100,
                'currency' => $paymentIntent->currency,
                'payment_type' => $request->payment_type,
                'description' => 'Payment made via Stripe',
            ]);

            // Return the client secret for the Payment Intent
            return inertia('Payment/Store',
                ['client_secret' => $paymentIntent->client_secret],
            );
        } catch (CardException $e) {
            // Handle any errors returned by Stripe
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
        public function index()
    {
        $payments = Payment::all();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $paintings = Painting::all();
        return view('payments.create', compact('paintings'));
    }


    public function edit(Payment $payment)
    {
        $paintings = Painting::all();
        return view('payments.edit', compact('payment', 'paintings'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validatedData = $request->validate([
            'painting_id' => 'required',
            'amount' => 'required|numeric',
            'currency' => 'required',
            'payment_method' => 'required',
        ]);

        $payment->update($validatedData);

        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully.');
    }
}