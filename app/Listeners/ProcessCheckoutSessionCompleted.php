<?php

namespace App\Listeners;

use App\Events\CheckoutSessionCompleted;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessCheckoutSessionCompleted implements ShouldQueue
{
    use InteractsWithQueue;
    public $checkoutSession;
    /**
     * Create the event listener.
     */
    public function __construct(CheckoutSessionCompleted $event)
    {
        $this->checkoutSession = $event;
    }

    /**
     * Handle the event.
     */
    public function handle(CheckoutSessionCompleted $event): void
    {

    }
}
