<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;
    protected $guarded = ['customer_id','type', 'name',
    'address1',
    'address2',
    'city',
    'state',
    'country',
    'postal_code'];
    protected $casts = [];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
