<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HashtagResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'hashtag'    => $this->hashtag,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by' => $this->created_by,
            'creator'    => new UserResource($this->whenLoaded('creator')),
            'contents'   => ContentResource::collection($this->whenLoaded('contents')), // tous les contenus liés
        ];
    }
}
