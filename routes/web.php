<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaintingController;
use App\Http\Controllers\StripeWebhookController;


// FAQ page
Route::get('/faq', [PageController::class, 'faq'])->name('faq');

// Donation page


// Donation confirmation page
Route::get('/thank-you', [PageController::class, 'donationConfirmation'])->name('donationConfirmation');

Route::get('/payments', [PaymentController::class, 'index'])
    ->name('payments.index');

Route::get('/payments/create', [PaymentController::class, 'create'])
    ->name('payments.create');

Route::post('/payments', [PaymentController::class, 'store'])
    ->name('payments.store');

Route::get('/payments/{payment}/edit', [PaymentController::class, 'edit'])
    ->name('payments.edit');

Route::put('/payments/{payment}', [PaymentController::class, 'update'])
    ->name('payments.update');

Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])
    ->name('payments.destroy');

Route::get('/profile/{id}/edit', [UserController::class, 'update'])->name('profile.edit');
Route::get('/paintings', PaintingController::class)->name('paintings.index');



Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])->middleware('stripe.webhook');
Route::middleware(['stripe.webhook'])->group(function(){
    Route::post('/create-checkout-session', function (Request $request) {
        \Stripe\Stripe::setApiKey(env('STRIPE_PUBLIC_KEY'));

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
    });
});
Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
});

