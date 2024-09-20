<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FieldResource extends JsonResource
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
            'owner' => $this->owner ? $this->owner->name : 'Unknown Owner',
            'province' => $this->province
        ];
    }
}
