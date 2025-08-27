<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'type'         => $this->type,
            'title'        => $this->title,
            'content'      => $this->content,
            'path_resource'=> $this->path_resource,
            'status'       => $this->status === '1',
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
            'deleted_at'   => $this->deleted_at,
            'created_by'   => $this->created_by,
            'category_id'  => $this->category_id,
            'creator'      => new UserResource($this->whenLoaded('creator')),
            'category'     => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
