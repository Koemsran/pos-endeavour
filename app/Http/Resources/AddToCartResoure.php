<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddToCartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'product' => [
                'id' => $this->product->id,
                'name' => $this->product->name,
                'description' => $this->product->description,
                'price' => $this->product->price,
                'colors' => $this->product->colors->pluck('name'), // Assuming you want names of colors
                'sizes' => $this->product->sizes->pluck('name'), // Assuming you want names of sizes
                'category_id' => $this->product->category_id,
                'image' => $this->product->image,
            ],
            'quantity' => $this->quantity,
            'price' => $this->price,
            'total_amount' => $this->total_amount,
        ];
    }
}
