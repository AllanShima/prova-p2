<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author_id' => $this->author_id,
            'genre_id' => $this->genre_id,
            'author' => new AuthorResource($this->whenLoaded('author')),
            'genre' => new GenreResource($this->whenLoaded('genre')),
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
        ];
    }
}
