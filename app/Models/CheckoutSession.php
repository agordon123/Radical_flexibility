<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Painting;
use Donation;
use Stripe\Checkout\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckoutSession extends Model
{
    use HasFactory;
    protected $fillable = ['stripe_session_id', 'order_id', 'product_id', 'payment_intent',
                            'payment_method', 'payment_method_details', 'customer_id', 'amount','object' ,'billing_details'];
    protected $casts = ['session_id' => 'string', 'product_id' => 'string', 'payment_method_details' => 'json','billing_details'=>'json'];

    public function order()
    {
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
    public function donation()
    {
        return $this->hasOne(Donation::class);
    }
    public function billingAddress()
    {
        return $this->hasOne(BillingAddress::class);
    }
}
