<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class OrderProductResource extends JsonResource
{
    public function toArray($request): array
    {
            return [
                'id' => $this->id,
                'user_id' => $this->user_id,
                'user' => $this->user ? $this->user->name : 'Unknown User',
                'order_date' => Carbon::parse($this->order_date)->translatedFormat('l, d F, Y'),
                'products' => ProductResource::collection($this->products),
                'created_at' => $this->created_at->format('d-m-Y'),
                'updated_at' => $this->updated_at->format('d-m-Y'),
            ];
    }
}
