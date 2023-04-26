<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Inertia\Inertia;
use App\Models\Product;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $input = $request->input();
        $validated = Validator::make([$request->all(),
        'product_id' => 'required|string',
        'price_id'=>'required|string'
    ]);

        if($input->product_id == 5 && $validated)
        {
            $product = Product::where('product_id' == $input->product_id);
        }
        Stripe::setApiKey(config('services.stripe.secret'));


        $domain = env('NGROK_URL');
        $crsfToken = csrf_token();
        $stripe = new StripeClient(config('services.stripe.secret'));
        $paymentMethods = $stripe->paymentMethods;
        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_type'=>[$paymentMethods],
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
          event($checkout_session);
          return Inertia::location($checkout_session->url,[$crsfToken]);
    }

}
