<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'comments'    => $this->comments,
            'question_id' => $this->question_id,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'deleted_at'  => $this->deleted_at,
            'created_by'  => $this->created_by,
            'creator'     => new UserResource($this->whenLoaded('creator')),   // relation avec users
            'question'    => new QuestionResource($this->whenLoaded('question')), // relation avec questions
        ];
    }
}
