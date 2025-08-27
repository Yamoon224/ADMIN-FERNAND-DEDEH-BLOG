<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type'         => ['required', 'in:PODCAST,ARTICLE'],
            'title'        => ['required', 'string', 'max:255'],
            'content'      => ['required', 'string'],
            'path_resource' => [
                'required_if:type,ARTICLE,PODCAST',
                function ($attribute, $value, $fail) {
                    if (request()->hasFile($attribute)) {
                        $validator = validator([$attribute => request()->file($attribute)], [$attribute => 'file|image|max:2048']);
                    } elseif (request('type') === 'PODCAST') {
                        $validator = validator([$attribute => $value], [$attribute => 'string|max:255']);
                    } else {
                        $fail('Le champ '.$attribute.' est requis.');
                        return;
                    }

                    if ($validator->fails()) {
                        $fail($validator->errors()->first($attribute));
                    }
                }
            ],
            'category_id'  => ['nullable', 'integer', 'exists:categories,id'],
            'created_by'   => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
