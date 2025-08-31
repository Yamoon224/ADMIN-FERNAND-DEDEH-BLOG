<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDailyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'introduction' => ['required'],
            'published_at' => ['required'],
            'created_by'   => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
