<?php

namespace App\Http\Controllers;

use App\Events\OrderInitiated;
use Stripe\Stripe;
use Inertia\Inertia;

use App\Models\Painting;
use App\Models\Product as ModelsProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stripe\Product;
use Stripe\StripeClient;

class PaintingController extends Controller
{
    public function index()
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
    public function show($id){

        $painting = Painting::find($id);


        return Inertia::render(`Paintings/{id?}`,['painting'=>$painting]);
    }
    public function create(Request $request){
        $request->validate([

        ]);
    }
    public function checkoutPainting(Request $request){
        Stripe::setApiKey(config('services.stripe.secret'));

        $product_id = $request->input('product');
        $product = ModelsProduct::where('product_id' == $product_id);
        $price_id = $product->price_id;
        $stripeProduct = Product::retrieve($product);





        $domain = env('NGROK_URL');
        $localDomain = 'https://localhost:8000';
        $crsfToken = csrf_token();
        $stripe = new StripeClient(config('services.stripe.secret'));
        $paymentMethods = $stripe->paymentMethods;
        $checkoutSession = \Stripe\Checkout\Session::create([
            'payment_method_type'=>[$paymentMethods],
            'line_items' => [[
              # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
              'price_id' => $price_id

            ]],
            'mode' => 'payment',
            'success_url' => $localDomain . route('painting.checkout.success'),
            'cancel_url' => $localDomain . route('painting.checkout.cancel'),
            'automatic_tax'=>[
                'enabled'=>false
            ]
          ]);
          event(OrderInitiated::class);

          return response()->json(['checkoutSession'=>$checkoutSession]);

    }


}
