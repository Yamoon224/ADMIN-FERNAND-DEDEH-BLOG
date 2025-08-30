<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'body'       => $this->body,
            'path_image' => $this->path_image,
            'hashtag_id' => $this->hashtag_id,
            'daily_id'   => $this->daily_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by' => $this->created_by,
            'creator'    => new UserResource($this->whenLoaded('creator')),  // relation avec users
            'hashtag'    => new HashtagResource($this->whenLoaded('hashtag')), // relation avec hashtags
            'daily'      => new DailyResource($this->whenLoaded('daily')),     // relation avec dailies
        ];
    }
}
