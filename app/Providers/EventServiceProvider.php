<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Laravel\Cashier\Events\WebhookReceived;
use App\Listeners\PaymentIntentCreatedListener;
use Stripe\Service\PaymentIntentService;
use Stripe\Service\WebhookEndpointService;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

            WebhookReceived::class => [
                StripeEventListener::class,
            ],

        PaymentIntentService::class => [
            PaymentIntentCreatedListener::class,
        ],
        WebhookEndpointService::class =>[
            WebhookReceived::class
        ],
        'App\Events\WebhookEndpointCreated' => [
            'App\Listeners\CreateWebhookEndpoint',
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return true;
    }
}
