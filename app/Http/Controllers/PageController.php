<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class PageController extends Controller
{
    public function home()
    {
        return Inertia::render('Home');
    }

    public function about()
    {
        return Inertia::render('About');
    }

    public function faq()
    {
        return Inertia::render('FAQ');
    }

    public function gallery()
    {
        return Inertia::render('Gallery');
    }

    public function donate()
    {
        return Inertia::render('Donate');
    }

    public function processDonation()
    {
        // Process the donation and redirect to a confirmation page
        return redirect()->route('donationConfirmation');
    }

    public function donationConfirmation()
    {
        return Inertia::render('DonationConfirmation');
    }
}
