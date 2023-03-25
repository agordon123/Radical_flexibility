<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{

    protected $connection = 'mysqli';
    protected $fillable = [
        'name',
        'email',
        'amount',
        'payment_id',
        'has_shipping_address'
    ];
    protected $casts = ['has_shipping_address'=>'boolean'];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function shipping_address()
    {
        return $this->hasOne(ShippingAddress::class,'id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}