<?php

namespace App\Http\Requests;

use App\Models\Movie;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MovieRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $movie = $this->movie;

        return [
            'title' => [
                'required',
                'string',
                Rule::unique(Movie::class, 'title')->ignore($movie),
            ],
            'description' => 'sometimes|string|nullable',
            'director' => 'sometimes|string|nullable',
            'year' => 'sometimes|integer|digits:4|nullable',
            'duration' => 'sometimes|integer|nullable',
            'score' => 'sometimes|numeric|between:0,10|nullable',
            'cover' => 'sometimes|string|nullable',
            'trailer' => 'sometimes|string|nullable',
            'categories' => 'sometimes|array',
            'categories.*' => 'required|integer|exists:categories,id',
            'actors' => 'sometimes|array',
            'actors.*' => 'required|integer|exists:actors,id',
        ];
    }

    public function messages()
    {
        return [
            'categories.*.exists' => 'The selected category ID is invalid.',
            'actors.*.exists' => 'The selected actor ID is invalid.',
        ];
    }
}
