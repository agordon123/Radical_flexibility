<?php

namespace App\Models;

use Money\Currency;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'order_id',
        'payment_intent_id',
        'status',
        'amount',
        'currency',
        'payment_type',
        'description',
        'stripe_charge_id'
    ];
    protected $casts = [
        'payment_id' => 'string',
        'customer_id' => 'integer',
        'order_id'=> 'integer',
        'amount'=>'decimal',
        'currency'=>'string'
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function currency()
    {
        return $this->hasMany(Currency::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
