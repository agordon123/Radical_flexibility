<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'donation_id',
        'order_id',
        'payment_intent_id',
        'amount',
        'currency',
        'payment_type',
        'description',
        'stripe_charge_id'
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }
    public function currency()
    {
        return $this->hasMany(Currency::class);
    }
    public function orders()
    {
        return $this->hasMany('orders');
    }
}