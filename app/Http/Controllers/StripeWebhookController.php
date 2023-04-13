<?php

namespace App\Http\Controllers;

use Stripe\Webhook;
use Inertia\Inertia;
use Stripe\WebhookEndpoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Exception\SignatureVerificationException;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function createEndpoint()
    {
        $endpoint = new WebhookEndpoint('we_1MvIDJDxs152QbBrli3IMN6U');
        return $endpoint;
    }
    /**
     * Handle a Stripe webhook request.
     */
    public function handleWebhook(Request $request)
    {
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
}
