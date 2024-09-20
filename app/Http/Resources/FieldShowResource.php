<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FieldShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'location' => $this->location,
            'image' => $this->image,
            'price' => $this->price,
            'field_type' => $this->field_type,
            'owner_name' => optional($this->owner)->name,
            'owner_id' => optional($this->owner)->id,
            'availablity' => $this->availablity
        ];
    }
}
