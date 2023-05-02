<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getPublicKeyAndProducts(Request $request)
    {
        $publishableKey = config('services.stripe.key');
        $stripeProducts = Product::all()->only('product_name','product_id','price_id','plink_id');
        return Inertia::render('Header',['publishableKey'=>$publishableKey,'products'=>$stripeProducts]);
    }
}
