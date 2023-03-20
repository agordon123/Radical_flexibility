<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'amount',
        'has_shipping_address'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function shipping_address()
    {
        return $this->hasOne(ShippingAddress::class);
    }

}