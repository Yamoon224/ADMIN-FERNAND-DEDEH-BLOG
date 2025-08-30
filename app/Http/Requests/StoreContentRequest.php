<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'body'       => ['nullable', 'string'],
            'path_image' => ['required', 'file', 'image', 'max:2048'],
            'hashtag_id' => ['required', 'integer', 'exists:hashtags,id'],
            'daily_id'   => ['required', 'integer', 'exists:dailies,id'],
            'created_by' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
