<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Product;
use Inertia\Inertia;

use App\Models\Order;
use App\Models\Painting;
use Stripe\StripeClient;
use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use App\Events\OrderInitiated;
use Illuminate\Support\Facades\Storage;
use App\Models\Product as ModelsProduct;

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
        $price_id = $request->input('product');
        $paintingId= $request->input('painting.id');

        $localDomain = 'https://localhost:8000';

        $stripe = new StripeClient(config('services.stripe.secret'));
        $url = env('NGROK_URL');

        $checkoutSession = \Stripe\Checkout\Session::create([
            'payment_method_types'=>['card'],

            'line_items' => [[
              # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
              'price' => $price_id,
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $localDomain . '/painting/checkout/success',
            'cancel_url' => $localDomain. '/painting/checkout/cancel',
            'automatic_tax'=>[
                'enabled'=>false
            ]
          ]);
       //   $order = new Order([
     //       'checkout_session_id' => $checkoutSession->id,
        //    'status' => OrderStatus::Unpaid,
      //      'painting_id'=>$paintingId
       // ]);

    //    $order->save();
     //   event(new OrderInitiated($order));

        return response()->json($checkoutSession);

    }
    public function checkoutSuccess(Request $request)
    {
        // Retrieve the session ID from the request parameters
        $sessionId = $request->input('session_id');

        // You can now use the session ID to retrieve payment details or perform other tasks

        // Return a view to display the success message
        return Inertia::render('painting/checkout/success',['sessionId'=>$sessionId]);
    }
    public function checkoutCancel(Request $request){
        $sessionId = $request->input('session_id');

        return Inertia::render('Checkout/Cancel',['sessionId'=>$sessionId]);
    }


}
