<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'currency',
        'payment_method',
        'stripe_charge_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }
    public function donation()
    {
        return $this->hasOne(Payment::class);
    }
}

