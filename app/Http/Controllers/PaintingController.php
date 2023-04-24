<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Painting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\PaintingRepository;

class PaintingController extends Controller
{
    public function __invoke()
    {

        $paintings = Painting::all();
        return Inertia::render('Home', ['paintings' => $paintings]);
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
    public function show(PaintingRepository $id){

        $painting = Painting::find($id);
        $product =Product::find($painting->product_id);

        return Inertia::render('Paintings/{id}',['painting'=>$painting]);
    }
    public function create(Request $request){
        $request->validate([

        ]);
    }



}
