<?php

namespace App\Listeners;

use App\Models\CheckoutSession;
use App\Models\Customer;
use Stripe\Event;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer as StripeCustomer;
use Stripe\Checkout\Session;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener implements ShouldQueue
{
    use  InteractsWithQueue;
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
    public function handle(Event $event)
    {
            // Set the Stripe API key
        Stripe::setApiKey(config('services.stripe.secret'));
        $payload = $event->payload;
        // Retrieve the event data
        $data = $event->data;
        $object = $data->object;
        $type = $payload['type'];
        $data = $payload['data']['object'];
        $events = [
            "*"
        ];

        switch ($type) {
            case 'charge.succeeded':
                $charge = Charge::retrieve($data['id']);
                $customer = $charge->customer;
                // Do something with the successful charge, like update your database or send a confirmation email
                break;

            case 'customer.created':
                $customer = StripeCustomer::retrieve($data['id']);
                $newCustomer = new Customer([]);
                $email = $customer->email;
                // Do something with the new customer, like send a welcome email
                break;

                // Add more cases here for other events that you want to handle
            case 'checkout.session.completed':
                $session = Session::retrieve($data['id']);
                $checkoutSession = CheckoutSession::find($session->id);
                $details = $session->total_details;
                foreach($session as $key){

                }
            default:
                // Handle any other events that don't match the cases above
                break;
        }

        return $event;
    }
}
