<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\Painting;
use Stripe\StripeClient;
use Stripe\PaymentIntent;
use Stripe\WebhookEndpoint;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use Stripe\Customer as StripeCustomer;
use Stripe\Service\WebhookEndpointService;

use function PHPUnit\Framework\throwException;
use Stripe\Exception\SignatureVerificationException;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class StripeWebhookController extends CashierController
{
    /**
     * Display a listing of the resource.
     */
    public function createEndpoint()
    {

        $url = env('NGROK_URL') . '/stripe/webhook';
        $stripe = new StripeClient(config('services.stripe.key'));
        $webhookEndpointService = new WebhookEndpointService($stripe);
        $webhookEndpoint = $webhookEndpointService->create([
                    'url' => env('APP_URL') .'stripe/webhook',
                    'enabled_events' => ['*'],
                    // additional configuration options as needed
                                                            ]);

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
        $payload = $request->all();

        // Use the WebhookSignature class to verify the request.
        try {
            $signature = $request->header('Stripe-Signature');
            $event = \Stripe\Webhook::constructEvent(
                $payload, $signature, config('cashier.webhook.secret')
            );
        } catch (SignatureVerificationException $exc) {
            throw($exc);
        }

        // Record the webhook event in your database or log file
        // For example:
        Log::info('Webhook received: ' . $event->type);

        // Handle the Stripe webhook event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $this->handleCompletedSession($session);
                break;
            case 'checkout.session_expired':
                $session = $event->data->object;
                $this->handleExpiredSession($session);
                break;
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $this->paymentSucceeded($paymentIntent);
                break;
            case 'payment_intent.failed':
                $paymentIntent = $event->data->object;
                $this->paymentFailed($paymentIntent);
                break;
            case 'charge_succeeded':
                $this->paymentSucceeded($event->data);
                break;
            default:
                break;
        }

        return response()->json(['success' => true]);
    }

    protected function paymentSucceeded($paymentIntent)
    {
        PaymentIntent::retrieve($paymentIntent);
        $payment = $paymentIntent;
        $status = $payment->paymentSucceeded;
        $dbPayment = Payment::where('payment_intent_id'==$paymentIntent->id);
        $dbPayment->status = 'paid';
        $dbPayment->save();
        return response('Payment Succeeded' + $payment->id,200);

    }

    protected function paymentFailed(PaymentIntent $paymentIntent)
    {
        $paymentIntent = PaymentIntent::retrieve($paymentIntent->id);
        $payment = $paymentIntent;
        $status = $payment->paymentFailed;
        $newPayment = new Payment(['payment_intent_id'=>$paymentIntent]);

    }
    protected function createWebhook()
    {
        $this->createEndpoint();


        // Return a response to the user
        return response('Webhook endpoint created successfully');
    }
    protected function handleCompletedDonation(Session $session)
    {
        $id = $session->id;
        $customer = \Stripe\Customer::retrieve($session->customer);
        $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);
        $payment = new Payment(['payment_intent_id'=>$session->payment_intent,'status'=>$session->payment_status,'amount_received'=>$paymentIntent->amount / 100]);
        $newCustomer = new Customer(['stripe_id'=>$customer,'email' => $session->customer_details->email,'checkout_session_id'=>$session->id]);
    }
    protected function handleCompletedSession(Session $session)
    {

        $customer = \Stripe\Customer::retrieve($session->customer);

        // Retrieve the Payment Intent
        $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

        // Check the Payment Intent status
        if ($paymentIntent->status != 'failed') {
            // Create a new Order
            Painting::query('id'== $session->metadata->painting);
            $order = new Order([
                'checkout_session_id' => $session->id,
                'payment_intent_id' => $paymentIntent->id,
                'customer_id' => $customer->id,
                'total' => $paymentIntent->amount / 100,
                'updated_at' => Carbon::now(),
                'painting_id' => $session->metadata->painting,
            ]);

            // Save the order
            $order->save();
        }
        $this->handleCreateCustomer($customer);
        $this->paymentSucceeded($paymentIntent);
        return response('Completed Session Handled', 200)->json();


   /*     $metadata = $session->metadata->toArray();
        foreach($metadata as $key => $value){
            if($key == 'donation' && $value == true){
                $this->handleCompletedDonation($session);
            }else{
                $painting = Painting::findOrFail($value);
            }
        }

        $customer = $session->customer;

        $newCustomer = new Customer(['stripe_id'=>$customer,'email' => $session->customer_details->email]);
        foreach($customer as $key){

        }
        $payment = $session->payment_intent;

        $paymentDetails = ['payment_intent_id',$session->payment_intent,];
        $intent = $payment->retrieve($session->payment_intent);
        $paintingId = $session->metadata;
        $painting = null;
        foreach($paintingId as $key){
            if($key == 'painting_id'){
                $painting = Painting::findOrFail($key);
                $painting->available = false;
            }
            else{
                   "address": null,
    "email": "example@example.com",
    "name": null,
    "phone": null,
    "tax_exempt": "none",
    "tax_ids": null
            }
        }
        $checkoutSession = $session->id;
        $sCustomer = StripeCustomer::retrieve( $session->customer);
        $customerDetails = $session->customer_details;

*/
        // Perform necessary actions with the session object, such as updating the order status
        // You can access the session properties like this: $session->id, $session->customer, etc.
    }
    protected function handleExpiredSession($session)
    {
    $data = $session->toArray();
    // Perform necessary actions with the session object for expired sessions
    // For example, update the corresponding order status in the database as expired
    }
    protected function handleCreateCustomer(StripeCustomer $customer)
    {
        $email = $customer->email;
        $payment_intent_id = $customer;
    }
}
