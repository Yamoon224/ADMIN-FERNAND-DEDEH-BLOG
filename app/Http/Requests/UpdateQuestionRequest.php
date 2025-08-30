<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'      => ['sometimes', 'nullable', 'string', 'max:150'],
            'body'       => ['sometimes', 'string'],
            'created_by' => ['sometimes', 'integer', 'exists:users,id'],
        ];
    }
}
