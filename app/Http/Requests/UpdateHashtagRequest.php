<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHashtagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hashtag'    => ['sometimes', 'string', 'max:150'],
            'created_by' => ['sometimes', 'integer', 'exists:users,id'],
        ];
    }
}
