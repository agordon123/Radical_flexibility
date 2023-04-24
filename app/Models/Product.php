<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable  = ['stripe_product_id','stripe_product_name','price_id','currency','plink_id'];
    protected $table = 'StripeProducts';

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function paintings()
    {
        return $this->hasMany(Painting::class);
    }
}
