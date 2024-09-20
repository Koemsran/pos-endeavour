<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $product = $this->products()->first();
        $discountedPrice = $product ? $product->discounted_price : null;

        return [
            'id' => $this->id,
            'title' => $this->title,
            'discount' => $this->discount,
            'discount_price' => $discountedPrice,
        ];
    }
}

