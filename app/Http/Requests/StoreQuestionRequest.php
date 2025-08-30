<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'      => ['nullable', 'string', 'max:150'],
            'body'       => ['required', 'string'],
            'created_by' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
