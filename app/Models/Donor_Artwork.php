<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor_Artwork extends Model
{
    use HasFactory;
    protected $fillable  = [];

    public function shipping_address()
    {
        return $this->hasOne(ShippingAddress::class);
    }
}