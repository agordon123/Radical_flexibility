<?php

namespace App\Models;


use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Painting extends Model
{

    protected $fillable = [
        'name',
        'title',
        'description',
        'available',
        'filename',
        'highend',
        'product_id'

    ];
    protected $with = ['product'];
    protected $casts = ['title' => 'string', 'available' => 'boolean','highend'=>'boolean','product_id'=>'integer'];

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function scopeProductId($id)
    {
        return $this->product_id === 'id';
    }
}
