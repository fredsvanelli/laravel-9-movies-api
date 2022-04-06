<?php

namespace App\Http\Requests;

use App\Models\Movie;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $movie = $this->movie;

        return [
            'title' => [
                'required',
                'string',
                Rule::unique(Movie::class, 'title')->ignore($movie),
            ],
            'description' => 'sometimes|string|nullable',
            'director' => 'required|string',
            'year' => 'required|integer|digits:4',
            'duration' => 'required|integer',
            'score' => 'required|integer',
            'cover' => 'sometimes|string|nullable',
            'trailer' => 'sometimes|string|nullable',
        ];
    }
}
