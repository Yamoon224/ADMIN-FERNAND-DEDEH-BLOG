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
            'image_path' => ['sometimes', 'file', 'image', 'max:2048'],
            'position'   => ['sometimes', 'in:HEADER,HOMEPAGE_TOP,HOMEPAGE_MIDDLE,HOMEPAGE_BOTTOM,SIDEBAR_LEFT,SIDEBAR_RIGHT,FOOTER,POPUP,MOBILE_TOP,MOBILE_BOTTOM'],
            'link'       => ['sometimes', 'url', 'max:255'],
            'status'     => ['sometimes', 'in:0,1'],
            'created_by' => ['sometimes', 'integer', 'exists:users,id'],
        ];
    }
}
