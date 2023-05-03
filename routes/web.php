<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PaintingController;
use App\Http\Controllers\StripeWebhookController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile/{id}/edit', [UserController::class, 'update'])->name('profile.edit');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/paintings',[PaintingController::class, 'index'])->name('paintings.index');
Route::get('/painting/{id?}', [PaintingController::class, 'show'])->name('painting.show');
Route::get('/create-webhook', [StripeWebhookController::class, 'createWebhook']);
Route::get('/donate/checkout/success', function (Request $request) {
    $checkoutSession = $request->user()->stripe()->checkout->sessions->retrieve($request->get('session_id'));

    return inertia('checkout.success', ['checkoutSession' => $checkoutSession]);
})->name('donate.checkout.success');
Route::get('/donate/checkout/cancel',[DonationController::class, 'checkoutCancel'])->name('donate.checkout.success');
Route::post('/painting/checkout', [PaintingController::class, 'checkoutPainting'])->name('painting.checkout');
Route::get('/painting/checkout/success',[PaintingController::class,'checkoutSuccess']);
Route::get('/painting/checkout/cancel',[PaintingController::class, 'checkoutCancel'])->name('painting.checkout.cancel');
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])->name('cashier.webhook');
Route::post('/donate/checkout', [DonationController::class,'checkoutDonation'])->name('donate.checkout');
/*Route::post('/create-checkout-session', function (Request $request) {
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    $price = $request->input('price');

    $product = \Stripe\Product::create([
        'name' => 'Painting',
    ]);

    $price = \Stripe\Price::create([
        'unit_amount' => $price * 100, // Price is in cents, so multiply by 100
        'currency' => 'usd',
        'product' => $product->id,
    ]);

    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [
            [
                'price' => $price->id,
                'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
        'success_url' => 'https://example.com/success',
        'cancel_url' => 'https://example.com/cancel',
    ]);

    return response()->json(['sessionId' => $session->id]);
}); */
