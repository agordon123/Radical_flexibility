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
        $paintings = Painting::with('product')->get();
        foreach ($paintings as $painting) {
            $product = $painting->product;
            $painting->attach( $product->product_id);
        }
        return Inertia::render('PaintingCard',['paintings'=>$paintings]);
    }
}
