<?php

namespace App\Http\Controllers;

use Stripe\Webhook;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Stripe\Exception\SignatureVerificationException;
use Stripe\WebhookEndpoint;
class StripeWebhookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function handleWebhook(Request $request)
    {
        // Retrieve the webhook payload and signature header from the request
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $event = null;

        try {
            $event = Webhook::constructEvent($payload, $sig_header, config('services.stripe.webhook_secret'));
        } catch (SignatureVerificationException $e) {
            return response()->json(['error' => $e], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                // Handle payment intent succeeded event
                break;
            case 'payment_intent.payment_failed':
                // Handle payment intent payment failed event
                break;
                case 'payment_link_created':
                    break;
                    case 'payment_intent.canceled';
                    break;
            // Handle other event types as needed
            default:
                // Unexpected event type
                return Inertia::response(['error' => 'Invalid event type'], 400);
        }

        return Inertia::response(['success' => true]);
    }

}
