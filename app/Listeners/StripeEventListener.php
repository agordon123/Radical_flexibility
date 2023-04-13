<?php

namespace App\Listeners;


use Laravel\Cashier\Events\WebhookReceived;
use Stripe\Event;

class StripeEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        $data = $event->data->object;
        dd($data);
    }
}
