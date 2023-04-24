<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Painting;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
        $paints = Painting::all();
        $lowEndPainting = Product::findOrFail(3);
        $highEndPainting = Product::findOrFail(2);
        foreach($paints as $paintings){
            if($paintings->highend){
                $paintings->product();
            }
        }
        $donationProduct = Product::findorFail(5);


        Stripe::setApiKey(config('services.stripe.secret'));
        $stripe_key = config('services.stripe.key');


        return Inertia::render('Home', ['paintings' => $paints,
        'stripeKey'=>$stripe_key,'highEndPainting' => $highEndPainting,'lowEndPainting'=>$lowEndPainting,'donationLink'=>$donationProduct]);
    }

}
