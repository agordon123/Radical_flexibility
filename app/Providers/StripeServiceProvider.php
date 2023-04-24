<?php

namespace App\Providers;


use Illuminate\Support\Facades\Event;
use Stripe\Stripe;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Events\WebhookReceived;
use Laravel\Cashier\Http\Controllers\WebhookController;


class StripeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        Event::listen(WebhookReceived::class,[WebhookController::class,'createWebhook'] );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
