<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExclusivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'      => ['required', 'string', 'max:150'],
            'body'       => ['required', 'string'],
            'created_by' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
