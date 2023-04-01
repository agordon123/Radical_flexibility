<?php

namespace App\Http\Controllers;

use App\Models\Painting;
use Illuminate\Http\Request;
use Inertia\Inertia;
class PaintingIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $paintings = Painting::all();
        return Inertia::render('Home',['paintings'=>$paintings]);
    }
}