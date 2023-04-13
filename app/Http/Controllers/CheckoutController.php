<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'name' => 'Example Item',
                    'description' => 'An example item for testing Stripe Checkout',
                    'images' => ['https://example.com/images/example.png'],
                    'amount' => 1000,
                    'currency' => 'usd',
                    'quantity' => 1,
                ],
            ],
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        return Inertia::render('Checkout/Index', [
            'sessionId' => $session->id,
            'publicKey' => env('STRIPE_PUBLISHABLE_KEY'),
            'secretKey'=>env('STRIPE_SECRET')
        ]);
    }
    public function process(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $request->input('amount'),
            'currency' => $request->input('currency'),
            'payment_method' => $request->input('payment_method'),
            'confirmation_method' => 'manual',
            'confirm' => true,
            'description' => $request->input('description')
        ]);

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }


    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $request->input('amount'),
            'currency' => $request->input('currency'),
            'payment_method' => $request->input('payment_method'),
            'confirmation_method' => 'manual',
            'confirm' => true,
            'description' => $request->input('description')
        ]);

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
