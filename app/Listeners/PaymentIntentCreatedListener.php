<?php

namespace App\Listeners;

use Closure;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Stripe\PaymentIntent;


class PaymentIntentCreatedListener implements ShouldQueue
{
    public function handle($event)
    {
        // Get the PaymentIntent object from the event
        $paymentIntent = $event->data->object;

        // Add your custom code here to handle the PaymentIntent creation event
        // For example, you could update your database or send a notification email
    }
}
