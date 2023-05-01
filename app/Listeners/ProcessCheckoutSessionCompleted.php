<?php

namespace App\Listeners;

use App\Events\CheckoutSessionCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessCheckoutSessionCompleted
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
    public function handle(CheckoutSessionCompleted $event): void
    {
        //
    }
}
