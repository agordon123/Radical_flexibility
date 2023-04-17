<?php

namespace App\Http\Controllers;

use Stripe\Webhook;
use Stripe\StripeClient;
use Stripe\WebhookEndpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Events\WebhookEndpointCreated;
use Stripe\Exception\SignatureVerificationException;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class StripeWebhookController extends CashierController
{
    /**
     * Display a listing of the resource.
     */
    public function createEndpoint()
    {
        $url = 'http://localhost:8000' . '/stripe/webhook';
        $endpoint = WebhookEndpoint::create([
            'url' => $url,
            'enabled_events' => ['*'],
            // additional configuration options as needed
        ]);
        return response()->json($endpoint);
    }
    /**
     * Handle a Stripe webhook request.
     */
    public function handleWebhook(Request $request)
    {
        $stripe = new StripeClient(config('stripe.secret'));
        $payload = $request->getContent();
        $sigHeader = $request->server('STRIPE_SIGNATURE');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, env('STRIPE_WEBHOOK_SECRET'));
        } catch (SignatureVerificationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        // Record the webhook event in your database or log file
        // For example:
        Log::info('Webhook received: ' . $event->type);

        // Handle the Stripe webhook event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $this->paymentSucceeded($event->data->object);
                break;
            case 'payment_intent.failed':
                $this->paymentFailed($event->data->object);
                break;
            case 'charge_succeeded':
                $this->paymentSucceeded($event->data->object);
                // Handle other events as needed
            default:
                // Ignore unsupported events
                break;
        }

        return response()->json(['success' => true]);
    }

    protected function paymentSucceeded($paymentIntent)
    {
        $payment = $paymentIntent;
        dd($payment);
    }

    protected function paymentFailed($paymentIntent)
    {
        $payment = $paymentIntent;
        dd($payment);
    }
    protected function createWebhook()
    {
        $this->createEndpoint();
        event(new WebhookEndpointCreated());

        // Return a response to the user
        return response('Webhook endpoint created successfully');
    }
}
