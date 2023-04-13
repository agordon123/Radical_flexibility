<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Request;
use Inertia\Inertia;

class PageController extends Controller
{
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
