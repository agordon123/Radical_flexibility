<?php
namespace App\Listeners;


use Illuminate\Auth\Events\Logout;
use Illuminate\Events\Dispatcher;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventSubscriber
{

    public function handleEvent(string $event): void {

    }

    /**
     * Register the listeners for the subscriber.
     */


    public function subscribe(Dispatcher $events): void
    {



    }
}
