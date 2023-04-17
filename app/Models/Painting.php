<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Painting extends Model
{

    protected $fillable = [
        'name',
        'title',
        'description',
        'price',
        'currency',
        'available',
        'filename',
    ];
    protected $casts = ['title' => 'string', 'available' => 'boolean'];

    public function orders()
    {
        return $this->belongsToOne(Order::class);
    }
}
