<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHashtagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hashtag'    => ['required', 'string', 'max:150'],
            'created_by' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
