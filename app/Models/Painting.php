<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Painting extends Model
{
    use Sluggable;

    protected $fillable = [
        'title',
        'description',
        'price',
        'quantity',
        'status'
    ];

    public function orders()
    {
        return $this->belongsToOne(Order::class);
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}