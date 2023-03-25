<?php

namespace App\Http\Controllers;

use App\Models\Painting;
use Illuminate\Http\Request;

class PaintingController extends Controller
{
    public function index()
    {
        $paintings = Painting::all();
        return inertia('Painting/Index',['paintings'=>$paintings]);
    }

    public function getAvailablePaintings()
    {
    $availablePaintings = Painting::where('available', true)->get();
    return inertia('paintings.index', ['paintings' => $availablePaintings]);
    }


}