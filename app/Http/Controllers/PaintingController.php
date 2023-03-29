<?php

namespace App\Http\Controllers;

use App\Models\Painting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaintingController extends Controller
{
    public function index()
    {
        $paintings = Painting::all();
        return inertia('Painting/Index',['paintings'=>$paintings]);
    }

    public function store(Request $request)
    {
    $request->validate([
        'image' => 'required|image',
    ]);

    // Store the uploaded image in the `storage/app/public` directory
    $path = $request->file('image')->store('public');

    // Get the public URL for the stored image
    $publicUrl = Storage::url($path);

    // Save the image information in the database
    $image = new Painting();
    $image->image_path = $publicUrl;
    $image->save();

    return redirect()->back()->with('success', 'Image saved successfully.');
    }
    public function getAvailablePaintings(Request $request)
    {
    $availablePaintings = Painting::where('status', true)->get();
    return inertia('paintings.index', ['paintings' => $availablePaintings]);
    }


}