<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name'     => ['sometimes', 'string', 'max:100'],
            'email'    => ['nullable', 'email', 'max:255', "unique:users,email,{$userId}"],
            'phone'    => ['sometimes', 'string', 'max:30', "unique:users,phone,{$userId}"],
            'password' => ['nullable', 'string', 'min:6'],
            'status'   => ['nullable', 'integer'],
            'locale'   => ['nullable', 'string', 'size:2'],
            'group_id' => ['sometimes', 'integer', 'exists:groups,id'],
        ];
    }
}
