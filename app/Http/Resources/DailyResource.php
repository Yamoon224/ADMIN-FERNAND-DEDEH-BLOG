<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'published_at' => $this->published_at,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
            'deleted_at'   => $this->deleted_at,
            'created_by'   => $this->created_by,
            'creator'      => new UserResource($this->whenLoaded('creator')), // relation avec users
            'contents'     => ContentResource::collection($this->whenLoaded('contents')), // relation avec contents
            'questions'    => QuestionResource::collection($this->whenLoaded('questions')), // relation avec questions
        ];
    }
}
