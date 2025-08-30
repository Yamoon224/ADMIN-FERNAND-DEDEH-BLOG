<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDailyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'published_at' => ['sometimes', 'date'],
            'created_by'   => ['sometimes', 'integer', 'exists:users,id'],
        ];
    }
}
