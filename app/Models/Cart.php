<?php

use App\Models\Painting;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'painting_id',
        'quantity',
        'total_price',
        'payment_intent_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function painting()
    {
        return $this->belongsTo(Painting::class);
    }
    public function payment(){
        return $this->hasOne(Payment::class);
    }
}
