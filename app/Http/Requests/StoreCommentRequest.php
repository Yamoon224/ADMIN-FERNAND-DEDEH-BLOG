<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comments'   => ['nullable', 'string'],
            'article_id' => ['required', 'integer', 'exists:articles,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}
