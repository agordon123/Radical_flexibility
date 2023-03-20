<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ShippingAddress extends Model
{
    protected $fillable = [
        'donor_artwork_id',
        'name',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'postal_code'
    ];

    public function donor_artwork()
    {
        return $this->belongsTo(Donor_Artwork::class);
    }
}