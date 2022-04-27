<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        $data = parent::toArray($request);

        return array_merge($data, [
            'movies' => $this->whenLoaded('movies'),
        ]);
    }
}
