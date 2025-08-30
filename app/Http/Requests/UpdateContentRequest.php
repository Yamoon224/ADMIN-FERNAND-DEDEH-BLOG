<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'body'       => ['sometimes', 'string'],
            'path_image' => ['sometimes', 'file', 'image', 'max:2048'],
            'hashtag_id' => ['sometimes', 'integer', 'exists:hashtags,id'],
            'daily_id'   => ['sometimes', 'integer', 'exists:dailies,id'],
            'created_by' => ['sometimes', 'integer', 'exists:users,id'],
        ];
    }
}
