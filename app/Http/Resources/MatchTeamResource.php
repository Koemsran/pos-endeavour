<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchTeamResource extends JsonResource
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
            'team_name' => $this->team_name,
            'team_logo' => $this->team_logo,
            'team_post_name' => $this->teamPost->name,
            'team_post_logo' => $this->teamPost->logo,
            'date_match' => $this->teamPost->date_match,
            'start_time' => \Carbon\Carbon::parse($this->teamPost->start_time)->format('h:i A'),
            'end_time' => \Carbon\Carbon::parse($this->teamPost->end_time)->format('h:i A'),
            'location' => $this->teamPost->location,
            'created_at' => $this->created_at->format('d-m-Y'),
        ];
    }
}
