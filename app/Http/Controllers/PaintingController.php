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
use Stripe\Checkout\Session;
use App\Events\OrderInitiated;
use App\Models\CheckoutSession;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Events\CheckoutSessionInitiated;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product as ModelsProduct;
use Carbon\Carbon;

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
    public function show($id)
    {

        $painting = Painting::find($id);
        return Inertia::render(`Paintings/{id?}`, ['painting' => $painting]);
    }

    public function checkoutPainting(Request $request)
    {
        // set secret key and get inputs
        Stripe::setApiKey(config('services.stripe.secret'));
        $price_id = $request->input('product');
        $paintingId = $request->input('painting.id');
        //set test url, create checkout session.  price id is an input, metadata has painting as the key and the id as the value.
        $url = env('NGROK_URL');
        $checkoutSession = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price' => $price_id,
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $url . '/painting/checkout/success',
            'cancel_url' => $url . '/painting/checkout/cancel',
            'automatic_tax' => [
                'enabled' => false
            ],
            'metadata' => [
                'painting' => $paintingId
            ],
            'customer_creation' => 'always',
        ]);


        $painting = Painting::where('id', '==', $paintingId)->first();
        $painting->status = false;
        $painting->save();
        $checkoutSession->metadata = ['painting' => $painting->id];
        $dbSession = new CheckoutSession(
            ['checkout_session_id', $checkoutSession->id, 'painting_id' => $painting->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        );
        $dbSession->save();


        return response()->json($checkoutSession);
    }
    public function checkoutSuccess(Request $request)
    {

        // Retrieve the session ID from the request parameters
        $sessionId = $request->input('session_id');
        $session = Session::retrieve($sessionId);
        $customer = $session->customer_email;
        //   $custy = new StripeCustomer('email'=>$customer->c);
        $paintingID = null;

        $dbSession = new CheckoutSession(['checkout_session_id' => $sessionId]);
        // You can now use the session ID to retrieve payment details or perform other tasks
        $customer = new Customer(['email' => $session->customer_email]);
        $session->customer_email;
        $payment = new Payment();
        $order = new Order();

        foreach ($session as $key) {
            if ($key == 'metadata') {
            }
        }
        // Return a view to display the success message
        return Inertia::render('painting/checkout/success', ['sessionId' => $sessionId]);
    }
    public function checkoutCancel(Request $request)
    {
        $sessionId = $request->input('session_id');
        $session = CheckoutSession::where('checkout_session_id' == $sessionId);
        $painting = Painting::find($session->metadata['painting']);
        $painting->available = true;

        return Inertia::render('Checkout/Cancel', ['sessionId' => $sessionId]);
    }
}
