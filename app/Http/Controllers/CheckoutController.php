<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Http\Controllers\Controller;
use App\Models\StripeProduct;
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

    public function createSession(Request $request)
    {
        $product =StripeProduct::find($request->input('product_id'));

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => $product->price * 100,
                        'product_data' => [
                            'name' => $product->name,
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],'mode' => 'payment',
            'success_url' => env('APP_URL') . '/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => env('APP_URL') . '/cancel',
        ]);

        return response()->json([
            'id' => $session->id,
        ]);
    }

}
