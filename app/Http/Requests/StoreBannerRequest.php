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
            'image_path' => ['required', 'file', 'image', 'max:2048'],
            'position'   => ['required', 'in:HEADER,HOMEPAGE_TOP,HOMEPAGE_MIDDLE,HOMEPAGE_BOTTOM,SIDEBAR_LEFT,SIDEBAR_RIGHT,FOOTER,POPUP,MOBILE_TOP,MOBILE_BOTTOM'],
            'link'       => ['nullable', 'url', 'max:255'],
            'status'     => ['nullable', 'in:0,1'],
            'created_by' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
