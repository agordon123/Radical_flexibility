<?php

namespace App\Models;

use Laravel\Cashier\Billable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use HasFactory; use Billable;

    protected $fillable = [

        'address',
        'metadata',
        'phone',
        'name',
        'email',
        'stripe_id',
        'card_brand',
        'card_last_four',
        'order_id'
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
    public function stripeId()
    {
        return $this->stripeId();
    }





}
