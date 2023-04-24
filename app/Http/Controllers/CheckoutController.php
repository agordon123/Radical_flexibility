<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Inertia\Inertia;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;

use App\Http\Controllers\Controller;
use App\Models\Product;


class CheckoutController extends Controller
{

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

    public function createCheckoutSession(Request $request)
    {
        $secretKey = config('services.stripe.key.secret');
        Stripe::setApiKey($secretKey);
        $painting = $request->input('painting');
        $orderedPainting = $painting;
        $stripe = new StripeClient($secretKey);
        $product = Product::where($request->input('product_id'));
        $stripeProductObject =  $stripe->products->retrieve($product->product_id);

        $price = $stripeProductObject->price_id;
        $paymentMethod = $stripe->paymentMethods;


        $myDomain = 'http://localhost:8000';
        $session = Session::create([
            'payment_method_types' =>[$paymentMethod],
            'line_items' => [
                [
                        'price'=>$price,
                        'currency' => 'usd',

                    'quantity' => 1,
                ],
            ],
            'mode'=>'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
            'automatic_tax'=>[
                'enabled'=>false
            ]
        ]);
        return Inertia::render('',['session'=>$session]);
/*
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[

            ]
                # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell

              ],
            ,'mode' => 'payment',
            'success_url' => $myDomain.'/donate/success?session_id={CHECKOUT_SESSION_ID}' . '/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $myDomain.'/donate/cancel?session_id={CHECKOUT_SESSION_ID}' . '/cancel',
        ]);

        return Inertia::render([
            'id' => $session->id,
        ]);*/
    }

}
