<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Home page
Route::get('/', [PageController::class, 'home'])->name('home');

// About us page
Route::get('/about', [PageController::class, 'about'])->name('about');

// FAQ page
Route::get('/faq', [PageController::class, 'faq'])->name('faq');

// Gallery page
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');

// Donation page
Route::get('/donate', [PageController::class, 'donate'])->name('donate');

// Handle donation form submission
Route::post('/donate', [PageController::class, 'processDonation'])->name('processDonation');

// Donation confirmation page
Route::get('/donate/thank-you', [PageController::class, 'donationConfirmation'])->name('donationConfirmation');
