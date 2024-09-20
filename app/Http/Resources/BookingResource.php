<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $startTime = new \DateTime($this->start_time);
        $endTime = new \DateTime($this->end_time);
        return [
            'id' => $this->id,
            'customer' => $this->customer->name,
            'field_name' => $this->field->name,
            'field_id' => $this->field->id,
            'start_time' => $startTime->format('h:i A'),
            'end_time' => $endTime->format('h:i A'),
            'total_price' => $this->total_price,
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
            'options' => $this->options->map(function ($option) {
                return [
                    'name' => $option->name,
                    'qty' => $option->pivot->qty
                ];
            })
        ];
    }
}
