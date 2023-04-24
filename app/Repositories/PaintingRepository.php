<?php

namespace App\Repositories;
use App\Models\Painting;

class PaintingRepository

{
    protected $paintings;

    public function __construct()
    {
        
    }
    public function getbyId($id){
        return Painting::find($id);
    }
}
