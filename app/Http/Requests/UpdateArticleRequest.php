<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type'         => ['sometimes', 'in:PODCAST,ARTICLE'],
            'title'        => ['sometimes', 'string', 'max:255'],
            'content'      => ['nullable', 'string'],
            'path_resource' => [
                'sometimes', // champ optionnel, ne s'exige que s'il est présent dans la requête
                function ($attribute, $value, $fail) {
                    $type = request('type');

                    if ($type === 'ARTICLE' && request()->hasFile($attribute)) {
                        $validator = validator([$attribute => request()->file($attribute)], [$attribute => 'file|image|max:2048']);
                    } elseif ($type === 'PODCAST' && !empty($value)) {
                        $validator = validator([$attribute => $value], [$attribute => 'string|max:255']);
                    } elseif ($type === 'ARTICLE' && !request()->hasFile($attribute)) {
                        // ARTICLE sans fichier fourni : on ignore car 'sometimes', pas de fail
                        return;
                    } elseif ($type === 'PODCAST' && empty($value)) {
                        // PODCAST sans URL fourni : on ignore car 'sometimes', pas de fail
                        return;
                    }

                    if (isset($validator) && $validator->fails()) {
                        $fail($validator->errors()->first($attribute));
                    }
                }
            ],
            'category_id'  => ['sometimes', 'integer', 'exists:categories,id'],
        ];
    }
}
