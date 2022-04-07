<?php

namespace App\Http\Requests;

use App\Models\Actor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(Actor::class, 'name')->ignore($this->actor),
            ],
            'picture' => 'sometimes|string|nullable',
            'biography' => 'sometimes|string|nullable',
            'birth_date' => 'sometimes|date|nullable',
            'birth_place' => 'sometimes|string|nullable',
            'movies' => 'sometimes|array',
            'movies.*' => 'required|integer|exists:movies,id',
        ];
    }

    public function messages()
    {
        return [
            'movies.*.exists' => 'The selected movie ID is invalid.',
        ];
    }
}
