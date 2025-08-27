<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['nullable', 'email', 'max:255', 'unique:users,email'],
            'phone'    => ['required', 'string', 'max:30', 'unique:users,phone'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
            'status'   => ['nullable', 'integer'],
            'locale'   => ['nullable', 'string', 'size:2'],
            'group_id' => ['required', 'integer', 'exists:groups,id'],
        ];
    }
}
