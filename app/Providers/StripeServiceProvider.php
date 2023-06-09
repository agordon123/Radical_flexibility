<?php

namespace App\Providers;



use Illuminate\Support\Facades\Event;
use Stripe\Stripe;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Events\WebhookReceived;
use App\Http\Controllers\StripeWebhookController;



class StripeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        Event::listen(WebhookReceived::class, [StripeWebhookController::class, 'handleWebhook']);


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }
}
