<?php

namespace App\Http\Controllers;

use App\Models\Painting;
use Illuminate\Http\Request;

class PaintingController extends Controller
{
    public function index()
    {
        $painting = Painting::all();
        return inertia('Painting/Index',[]);
    }

    public function getAvailablePaintings()
    {
    $availablePaintings = Painting::where('available', true)->get();
    return inertia('paintings.index', ['paintings' => $availablePaintings]);
    }

}