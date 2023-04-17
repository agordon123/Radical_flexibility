<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\StripeProduct;

class GeneralController extends Controller
{
    public function getPublicKeyAndProducts(Request $request)
    {
        $publishableKey = config('services.stripe.key');
        $stripeProducts = StripeProduct::all()->only('product_name','product_id','price_id','plink_id');
        return Inertia::render('Header',['publishableKey'=>$publishableKey,'products'=>$stripeProducts]);
    }
}
