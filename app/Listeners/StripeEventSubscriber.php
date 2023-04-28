<?php
namespace App\Listeners;


use Illuminate\Auth\Events\Logout;
use Illuminate\Events\Dispatcher;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleUserLogin(string $event): void {}

    /**
     * Handle user logout events.
     */
    public function handleUserLogout(string $event): void {}

    public function handleEvent(string $event): void {}

    /**
     * Register the listeners for the subscriber.
     */


    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            WebhookReceived::class,
            [StripeEventSubscriber::class, 'handleEvent']
        );

        $events->listen(
            Logout::class,
            [UserEventSubscriber::class, 'handleUserLogout']
        );
    }
}
