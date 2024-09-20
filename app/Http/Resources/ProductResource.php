<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'qty' => $this->pivot->qty,
            'price' => number_format($this->price, 2),
            'total' => number_format($this->pivot->qty * $this->price, 2),
            'color' => $this->pivot->color_id ? $this->colors->firstWhere('id', $this->pivot->color_id)->name ?? null : null,
            'size' => $this->pivot->size_id ? $this->sizes->firstWhere('id', $this->pivot->size_id)->name ?? null : null,
        ];
    }

}
