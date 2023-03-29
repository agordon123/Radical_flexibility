<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaintingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'artist'=>$this->artist,
            'description'=>$this->description,
            'price'=>$this->price,
            'currency'=>$this->currency,
            'image_path'=>$this->image_path,
            'status'=>$this->status
                            ];
    }
}