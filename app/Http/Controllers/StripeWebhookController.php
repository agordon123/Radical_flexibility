<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\StripeClient;
use Stripe\WebhookEndpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Service\WebhookEndpointService;
use Stripe\Exception\SignatureVerificationException;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Stripe\Checkout\Session;

class StripeWebhookController extends CashierController
{
    /**
     * Display a listing of the resource.
     */
    public function createEndpoint()
    {

        $url = 'http://localhost:8000' . '/stripe/webhook';
        $stripe = new StripeClient(config('services.stripe.key'));
        $webhookEndpointService = new WebhookEndpointService($stripe);
        $webhookEndpoint = $webhookEndpointService->create([
                    'url' => 'https://example.com/stripe/webhook',
                    'enabled_events' => ['*'],
                    // additional configuration options as needed
                                                            ]);

        $endpoint = WebhookEndpoint::create([
            'url' => $url,
            'enabled_events' => ['*'],
            // additional configuration options as needed
        ]);
        $endpoint->save();
        return response()->json($endpoint);
    }
    /**
     * Handle a Stripe webhook request.
     */
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();

        // Use the WebhookSignature class to verify the request.
        $signature = $request->header('Stripe-Signature');
        $event = \Stripe\Webhook::constructEvent(
            $payload, $signature, config('cashier.webhook.secret')
        );
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
                break;
                case 'checkout.session.completed':
                    $session = Session::retrieve($event->data->object);
                    case 'checkout.session.async_payment_succeeded':
                    break;
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


        // Return a response to the user
        return response('Webhook endpoint created successfully');
    }
    protected function sessionCompleted(){
        return $this->successMethod();
    }
}
