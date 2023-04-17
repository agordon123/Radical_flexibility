<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentLink;
use App\Models\StripeProduct;
use Inertia\Inertia;

class PaymentLinkController extends Controller
{
    public function __invoke(Request $request)
    {
        $paymentLinks = StripeProduct::all()->only('product_name','product_id','price_id','plink_id');
        return Inertia::render('Header',['paymentLinks'=>$paymentLinks]);

    }
}
