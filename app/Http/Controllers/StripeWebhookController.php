<?php


namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\Painting;
use Stripe\PaymentIntent as StripePaymentIntent;
use Stripe\WebhookEndpoint;
use Illuminate\Http\Request;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Log;
use Stripe\Customer as StripeCustomer;
use Stripe\Exception\SignatureVerificationException;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class StripeWebhookController extends CashierController
{
    /**
     * Display a listing of the resource.
     */
    public function createEndpoint()
    {
        // needs to be replaced by app url in production
        $url = env('NGROK_URL') . '/stripe/webhook';
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
        $event = $this->verifyWebhook($request);

        Log::info('Webhook received: ' . $event->type);

        switch ($event->type) {
            case 'checkout.session.completed':
                $this->handleCompletedSession(StripeSession::constructFrom($event->data->object));
                break;
            case 'checkout.session_expired':
                $this->handleExpiredSession(StripeSession::constructFrom($event->data->object));
                break;
            case 'payment_intent.succeeded':
                $this->paymentSucceeded(StripePaymentIntent::constructFrom($event->data->object));
                break;
            case 'payment_intent.failed':
                $this->paymentFailed(StripePaymentIntent::constructFrom($event->data->object));
                break;
            default:
                break;
        }

        return response()->json(['success' => true]);
    }
    private function verifyWebhook(Request $request)
    {
        $payload = $request->all();
        $signature = $request->header('Stripe-Signature');

        try {
            return \Stripe\Webhook::constructEvent($payload, $signature, config('cashier.webhook.secret'));
        } catch (SignatureVerificationException $exc) {
            throw ($exc);
        }
    }
    protected function paymentSucceeded(StripePaymentIntent $paymentIntent)
    {
        $dbPayment = Payment::where('payment_intent_id', $paymentIntent->id)->first();
        $dbPayment->status = 'paid';
        $dbPayment->save();

        return response('Payment Succeeded' . $paymentIntent->id, 200);
    }

    protected function paymentFailed(StripePaymentIntent $paymentIntent)
    {
        $newPayment = new Payment(['payment_intent_id' => $paymentIntent->id]);
    }

    protected function createWebhook()
    {
        $this->createEndpoint();
        return response('Webhook endpoint created successfully');
    }


    // Return a response to the user

    protected function handleCompletedSession(StripeSession $session)
    {
        $customer = StripeCustomer::retrieve($session->customer);
        $paymentIntent = StripePaymentIntent::retrieve($session->payment_intent);

        if ($paymentIntent->status != 'failed') {
            $order =            $order = new Order([
                'checkout_session_id' => $session->id,
                'payment_intent_id' => $paymentIntent->id,
                'customer_id' => $customer->id,
                'total' => $paymentIntent->amount / 100,
                'updated_at' => Carbon::now(),
                'painting_id' => $session->metadata->painting,
            ]);

            $order->save();
        }

        $this->handleCreateCustomer($customer);
        $this->paymentSucceeded($paymentIntent);

        return response('Completed Session Handled', 200)->json();
    }
    protected function handleExpiredSession(StripeSession $session)
    {
        // Perform necessary actions with the session object for expired sessions
        // For example, update the corresponding order status in the database as expired
    }

    protected function handleCreateCustomer(StripeCustomer $customer)
    {
        $email = $customer->email;
        $payment_intent_id = $customer;
        $newCustomer = new Customer();
    }

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
  /*  protected function handleExpiredSession($session)
    {
    $data = $session->toArray();
    // Perform necessary actions with the session object for expired sessions
    // For example, update the corresponding order status in the database as expired
    }
    protected function handleCreateCustomer(StripeCustomer $customer)
    {
        $email = $customer->email;
        $payment_intent_id = $customer;
    } */
