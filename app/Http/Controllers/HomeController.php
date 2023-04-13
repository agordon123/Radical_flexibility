<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Painting;
use App\Models\StripeProduct;

class HomeController extends Controller
{

    public function index()
    {
        $paints = Painting::all();
        $products = StripeProduct::all();

        return Inertia::render('Home', ['paintings' => $paints,'products'=>$products]);
    }

}
