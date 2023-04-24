<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutSession extends Model
{
    use HasFactory;
    protected $fillable = ['session_id','sessionObject','order_id','product_id'];
    protected $casts = ['session_id'=>'string','sessionObject'=>'json','product_id'=>'string'];

    public function order(){
        return $this->hasOne(Order::class);
    }
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
    public function product()
    {
        return $this->hasOne(Painting::class);
    }
}
