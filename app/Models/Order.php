<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;


    protected $table = 'orders';

    protected $fillable = [
        'order_number',
        'donor_id',
        'shipping_address_id',
        'billing_address_id',
        'subtotal',
        'total',
        'payment_method',
        'payment_id',
        'status',
        'shipping_cost',
        'order_status'
    ];

    public function donors()
    {
        return $this->belongsTo(Donor::class,'donor_id','id');
    }

    public function shippingAddress()
    {
        return $this->belongsTo(Shipping_Address::class, 'shipping_address_id','id');
    }


    public function items()
    {
        return $this->hasMany(Painting::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function checkoutSession()
    {
        return $this->hasOne(CheckoutSession::class);
    }
}
