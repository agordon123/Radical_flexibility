<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Inertia\Inertia;
use App\Models\Customer;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\StripeProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function createDonationCheckoutSession(CheckoutRequest $request)
        {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $secretKey = Stripe::getApiKey();
            $stripe = new StripeClient($secretKey);
            $header  = header('Content-Type:application/json');
            $paymentMethods = $stripe->paymentMethods;
            $YOUR_DOMAIN = 'http://localhost:4242';

            $product = StripeProduct::where('product_id' == $request->product_id);
            $stripeProductObject =  $stripe->products->retrieve($product->product_id);
            $crsfToken = csrf_token();
            //$product = StripeProduct::where('product_id' == $product_id);
          //  $line_items = $stripe->paymentLinks->allLineItems('plink_1MxencDxs152QbBrXpq2q9iT', ['limit' => 3]);
            $session = Session::create([
                'payment_method_types' => $paymentMethods,
                'line_items' => [
                    [
                            'price'=>$product->price_id,
                            'currency' => 'usd',
                            'tax_behavior'=> $stripeProductObject->tax_code,
                        'quantity' => 1,
                    ],
                ],
                'success_url' => route('checkout.success'),
                'cancel_url' => route('checkout.cancel'),
                'automatic_tax'=>[
                    'enabled'=>false
                ]
            ]);

            return Inertia::render('Header',[$session,303,$header]);;
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
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripeProductObject =  $stripe->products->retrieve($product->product_id);
        $product =StripeProduct::find($request->input('product_id'));
        $price = $product->price_id;


        $currency = $product->currency;
        $name = $product->name;
        $product_id = $product->product_id;
        $price_id = $product->price_id;
        $myDomain = 'http://localhost:8000';
        $session = Session::create([
            'payment_method_types' => $paymentMethods,
            'line_items' => [
                [
                        'price_id'=>$price,
                        'currency' => 'usd',
                        'tax_behavior'=> $stripeProductObject->tax_code,
                    'quantity' => 1,
                ],
            ],
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
            'automatic_tax'=>[
                'enabled'=>false
            ]
        ]);
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
