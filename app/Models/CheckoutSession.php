<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Painting;
use Stripe\Checkout\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->hasOne(User::class);
    }
    public function painting()
    {
        return $this->hasOne(Painting::class);
    }
    public function stripeProduct()
    {
        return $this->hasOne(Product::class);
    }
    public function checkoutSessions()
    {
        return $this->hasOne(Session::class);
    }
}
