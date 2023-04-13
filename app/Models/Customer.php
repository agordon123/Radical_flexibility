<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Cashier\Billable;
use \Stripe\Customer as StripeCustomer;
class Customer extends StripeCustomer
{
    use HasFactory, Billable;

    protected $fillable = [

        'address',
        'metadata',
        'phone',
        'name',
        'email',
        'stripe_id',
        'card_brand',
        'card_last_four',
    ];

    protected $hidden = [
        'card_brand',
        'card_last_four',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'trial_ends_at' => 'datetime',
        'subscription_ends_at' => 'datetime',
    ];

}
