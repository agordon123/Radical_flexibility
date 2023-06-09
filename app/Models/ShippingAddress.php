<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ShippingAddress extends Model
{
    protected $fillable = [
        'customer_id',
        'name',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'postal_code'
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
