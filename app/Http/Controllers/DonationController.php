<?php

namespace App\Http\Controllers;

use Donation;
use Money\Money;
use Stripe\Stripe;
use Money\Currency;
use App\Models\Donor;
use App\Models\Payment;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Money\Currencies\ISOCurrencies;
use App\Http\Controllers\Controller;
use Money\Formatter\IntlMoneyFormatter;

class DonationController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        // Retrieve the donation amount and currency from the request
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        // Create a new instance of the Stripe API client
        $stripe = new Stripe(config('services.stripe.secret'));

        // Create a PaymentIntent object for the donation
        $intent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => $currency,
            'description' => 'Donation',
        ]);

        // Convert the donation amount to a Money object
        $money = new Money($amount, new Currency($currency));

        // Create a formatter object for the currency
        $formatter = new IntlMoneyFormatter(new \NumberFormatter('en_US', \NumberFormatter::CURRENCY), new ISOCurrencies());

        // Format the donation amount for display
        $amount_formatted = $formatter->format($money);

        // Return a view with the PaymentIntent ID and formatted donation amount
        return view('donation.create', [
            'client_secret' => $intent->client_secret,
            'amount_formatted' => $amount_formatted,
        ]);
    }
        public function donate(Request $request)
        {
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $stripe = new Stripe(config('services.stripe.secret'));

        // Create a PaymentIntent for the donation amount
        $intent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => $currency,
            'description' => 'Donation',
        ]);

        // Store the PaymentIntent ID in your database along with the donor's information
        $donation = new Payment([]);
        $donation->amount = $request->input('amount');
        $donation->receive_artwork = $request->input('receive_artwork', false);
        $donation->payment_intent_id = $intent->id;
        $donation->save();

        // Return the client secret to the front-end so it can complete the payment
        return response()->json(['client_secret' => $intent->client_secret]);
    }


        public function handlePayment(Request $request)
    {
        $stripe = new Stripe(config('services.stripe.secret'));

        // Retrieve the PaymentIntent using the ID sent by the client
        $intent = PaymentIntent::retrieve($request->input('payment_intent_id'));

        // Handle any errors that may have occurred during payment processing
        if ($intent->status === 'requires_payment_method') {
            return response()->json(['error' => 'Payment failed']);
        }

        // Update the donation record with information about the payment
        $donation = Payment::where('payment_intent_id', $intent->id)->firstOrFail();
        $donation->payment_status = $intent->status;
        $donation->transaction_id = $intent->charges->data[0]->id;
        $donation->save();

        // If the donor requested artwork, prompt them to enter their shipping address
        if ($donation->receive_artwork) {
            return redirect()->route('donation.shipping', ['donation' => $donation->id]);
        }

        // Otherwise, thank them for their donation
        return view('donation.thank_you');
    }

        public function index()
    {
        $donations = Donation::all();
        return view('donations.index', compact('donations'));
    }

    public function create()
    {
        $donors = Donor::all();
        return view('donations.create', compact('donors'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'donor_id' => 'required',
            'amount' => 'required|numeric',
        ]);

        $donation = Donation::create($validatedData);

        return redirect()->route('donations.index')
            ->with('success', 'Donation created successfully.');
    }

    public function edit(Donation $donation)
    {
        $donors = Donor::all();
        return view('donations.edit', compact('donation', 'donors'));
    }

    public function update(Request $request, Donation $donation)
    {
        $validatedData = $request->validate([
            'donor_id' => 'required',
            'amount' => 'required|numeric',
        ]);

        $donation->update($validatedData);

        return redirect()->route('donations.index')
            ->with('success', 'Donation updated successfully.');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();

        return redirect()->route('donations.index')
            ->with('success', 'Donation deleted successfully.');
    }
}