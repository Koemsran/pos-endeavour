<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgressResource extends JsonResource
{
      /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'step_number' => $this->step_number,
            'client_id' => $this->client_id,
            'client_name' => $this->client->name ?? null, // Ensure the client relationship exists
            'client_phone_number' => $this->client->phone_number ?? null,
            'client_age' => $this->client->age ?? null,
        ];
    }
}
