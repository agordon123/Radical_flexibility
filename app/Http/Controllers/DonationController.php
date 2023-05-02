<?php

namespace App\Http\Controllers;

use App\Events\CheckoutSessionInitiated;
use Stripe\Stripe;
use App\Models\Product;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Events\OrderInitiated;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;


class DonationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function checkoutDonation(Request $request)
    {
        $input = $request->input('price_id');
        $donationproduct = Product::where('price_id','==',$input);
        if(
            $input == 5 && $donationproduct->price_id)
        {
            $product = Product::where('product_id' == $input->product_id);
        }
        Stripe::setApiKey(config('services.stripe.secret'));


        $domain = env('NGROK_URL');
        $crsfToken = csrf_token();
        $stripe = new StripeClient(config('services.stripe.secret'));
        $paymentTypes = [];
        foreach($stripe->paymentMethods->all() as $key){


        }
        $checkoutSession = \Stripe\Checkout\Session::create([
            'payment_method_type'=>['card'],
            'line_items' => [[
              # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
              'price_id' => $product->price_id,

            ]],
            'mode' => 'payment',
            'success_url' => $domain . route('donate.checkout.success'),
            'cancel_url' => $domain . route('donate.checkout.cancel'),
            'automatic_tax'=>[
                'enabled'=>false
            ]
          ]);


          return response()->json(['sessionId' => $checkoutSession->id]);
    }

}
