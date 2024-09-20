<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
        'user_id' => $this->user_id,
        'date_match' => $this->date_match,
        'logo' => $this->logo,
        'start_time' => $this->start_time,
        'end_time' => $this->end_time,
        'post_date' => $this->post_date,
        'location' => $this->location,
        'status' => $this->status,
        'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
       ];
    }
}
