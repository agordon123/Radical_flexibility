<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class DonationController extends Controller
{
    public function createDonationForm()
    {
        $client = new Client([
            'base_uri' => 'https://api.givelify.com/',
        ]);

        $response = $client->request('POST', 'v1/donation_forms', [
            'headers' => [
                'Authorization' => 'Bearer <YOUR_ACCESS_TOKEN>',
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'name' => 'My Nonprofit',
                'description' => 'Donate to support our cause!',
                'logo_url' => 'https://example.com/logo.png',
                'amounts' => [
                    ['amount' => 10.00, 'label' => '$10'],
                    ['amount' => 25.00, 'label' => '$25'],
                    ['amount' => 50.00, 'label' => '$50'],
                ],
            ],
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        return $data;
    }
}

