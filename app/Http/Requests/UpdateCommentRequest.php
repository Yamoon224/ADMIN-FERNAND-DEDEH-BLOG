<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comments'   => ['nullable', 'string'],
            'article_id' => ['sometimes', 'integer', 'exists:articles,id'],
        ];
    }
}
