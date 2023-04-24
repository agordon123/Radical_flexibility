<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $id = null)
    {
       $product = Product::findOrFail($id);
       return Inertia::render('Components/PaintingCard',['product'=>$product]);
    }
}
