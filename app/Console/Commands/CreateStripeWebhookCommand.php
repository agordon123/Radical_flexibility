<?php

namespace App\Console\Commands;

use App\Http\Controllers\StripeWebhookController;
use App\Listeners\CreateWebhookEndpoint;
use Illuminate\Console\Command;
use Stripe\StripeClient;
use Stripe\WebhookEndpoint;

class CreateStripeWebhookCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-stripe-webhook-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $stripeClient = new StripeClient(config('services.stripe.secret'));
        $stripeClient->webhookEndpoints->create();

    }
}
