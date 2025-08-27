<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:150'],
            'image_path' => ['required', 'file', 'image', 'max:2048'],
            'link'        => ['nullable', 'url', 'max:255'],
            'status'      => ['nullable', 'integer'],
            'created_by'  => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}
