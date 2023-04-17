<?php

namespace App\Providers;

use Stripe\Stripe;
use Illuminate\Support\ServiceProvider;

class StripeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Stripe::setApiKey(config('stripe.secret_key'));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
