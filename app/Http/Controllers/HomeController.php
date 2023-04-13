<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Inertia\Inertia;
use App\Models\Painting;
use App\Models\PaymentLink;

class HomeController extends Controller
{

    public function index()
    {
        $paints = Painting::all();
        $paymentLinks = PaymentLink::all();
        $stripeKey = Stripe::setApiKey(config('services.stripe.key'));
        return Inertia::render('Home', ['paintings' => $paints,'paymentLinks'=>$paymentLinks,'stripeKey'=>$stripeKey]);
    }

}
