<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    public function toArray($request)
    {
        return array_merge(
            parent::toArray($request),
            [
                'categories' => CategoryResource::collection($this->whenLoaded('categories')),
                'actors' => ActorResource::collection($this->whenLoaded('actors')),
            ]
        );
    }
}
