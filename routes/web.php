<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaintingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', PaintingController::class);
// About us page
Route::get('/about', [PageController::class, 'about'])->name('about');
// FAQ page
Route::get('/faq', [PageController::class, 'faq'])->name('faq');

// Gallery page
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');

// Donation page
Route::get('/donate', [PageController::class, 'donate'])->name('donate');
// Handle donation form submission
Route::post('/donate', [DonationController::class, 'processDonation'])->name('processDonation');

// Donation confirmation page
Route::get('/donate/thank-you', [PageController::class, 'donationConfirmation'])->name('donationConfirmation');

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
Route::get('/paintings', [PaintingController::class, 'PaintingController@getAvailablePaintings'])
    ->where('path', '.*')
    ->name('painting/{id}');
Route::resource('paintings', [PaintingController::class, '']);
