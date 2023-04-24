<?php


use Stripe\Price;
use Stripe\Stripe;
use Stripe\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PaintingController;
use App\Http\Controllers\StripeWebhookController;
use Laravel\Cashier\Http\Controllers\WebhookController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile/{id}/edit', [UserController::class, 'update'])->name('profile.edit');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/painting/{painting}', [PaintingController::class, 'show'])->name('painting.show');

Route::post('/donate/checkout',DonationController::class)->name('donate.checkout');
Route::get('/create-webhook', [StripeWebhookController::class, 'createWebhook']);


Route::post('/painting/checkout', [CheckoutController::class, 'createSession'])->name('painting.checkout');
Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook'])->name('cashier.webhook');

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
