<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Painting;


class HomeController extends Controller
{

      public function index()
    {
        $paints = Painting::all();
        return Inertia::render('Home',['paintings'=>$paints]);
    }
}