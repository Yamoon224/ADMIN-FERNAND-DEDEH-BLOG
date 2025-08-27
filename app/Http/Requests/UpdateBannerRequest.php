<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['sometimes', 'string', 'max:150'],
            'image_path' => ['sometimes', 'file', 'image', 'max:2048'],
            'link'        => ['nullable', 'url', 'max:255'],
            'status'      => ['nullable', 'integer'],
        ];
    }
}
