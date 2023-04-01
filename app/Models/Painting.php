<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Painting extends Model
{
    use Sluggable;
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
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}