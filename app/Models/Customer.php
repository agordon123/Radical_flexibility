<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Customer extends Model
{
    use HasFactory;
    use Billable;
    protected $guarded = [];
    protected $fillable = ['name', 'Address', 'description', 'email', 'metadata', 'payment_method', 'phone', 'shipping'];
    protected $casts = [
        'name' => 'string',
        'Address' => 'json',
        'description' => 'string',
        'email' => 'string',
        'metadata' => 'json',
        'payment_method' => 'string',
        'phone' => 'string',
        'shipping' => 'json'
    ];
    public function shippingAddresses()
    {
        return $this->hasOne(ShippingAddress::class,'id','customer_id');
    }
}
