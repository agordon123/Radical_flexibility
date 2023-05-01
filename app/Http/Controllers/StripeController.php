<?php

namespace App\Http\Controllers;

use App\Console\Commands\CreateStripeWebhookCommand;
use Illuminate\Http\Request;
use Stripe\Product;
class StripeController extends Controller
{
    public function createProduct(Request $request,Product $product)
    {

    }
}
