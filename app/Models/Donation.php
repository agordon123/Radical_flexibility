<?php

use App\Models\Donor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Donation extends Model
{
    use HasFactory; use Billable;


    protected $fillable = [
        'user_id',
        'amount',
        'currency',
        'payment_method',
        'stripe_charge_id',
    ];

    public function user()
    {
        return $this->belongsTo(Donor::class,'id');
    }
    public function donation()
    {
        return $this->hasOne(Payment::class);
    }
    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
