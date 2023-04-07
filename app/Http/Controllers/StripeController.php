<?php

namespace App\Http\Controllers;

use Stripe\WebhookEndpoint;

class StripeController extends Controller
{
    use WebhookEndpoint;
    public function checkOut()
    {

    }
    public function createWebhook()
    {

        $webhook = WebhookEndpoint::create([
            'id' => 'we_1Mtv2dDxs152QbBrh7LYKsFU',
            'description' => 'This is my webhook, I like it a lot',
            'url' => 'https://example.com/my/webhook/endpoint',
            'enabled_events' => [
                'charge.failed',
                'charge.succeeded',
            ],
        ]);

    }
}
