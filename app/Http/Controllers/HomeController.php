<?php

namespace App\Http\Controllers;

use App\Models\Painting;
use Inertia\Inertia;

class HomeController extends Controller
{

    public function index()
    {
        $paints = Painting::all();
        return Inertia::render('Home', ['paintings' => $paints]);
    }

}