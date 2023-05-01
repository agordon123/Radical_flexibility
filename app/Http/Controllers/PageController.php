<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Painting;
use GuzzleHttp\Psr7\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function home()
    {
        $paints = Painting::all();
        $products = Product::all();
        $publicKey = config('services.stripe.key');

        return Inertia::render('Home', ['paintings' => $paints,'products'=>$products,'publicKey'=>$publicKey]);
    }
    public function about()
    {
        return Inertia::render('About');
    }

    public function faq()
    {
        return Inertia::render('FAQ');
    }

    public function gallery()
    {
        return Inertia::render('Gallery');
    }

    public function donate()
    {
        return Inertia::render('Donate');
    }
    public function checkout(Request $request)
    {

    }

}
