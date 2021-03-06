<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Country\CountryResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "slug" => $this->slug,
            "description" => $this->description,
            "price" => $this->formattedPrice($this->price),
            "image" => $this->image,
            "country" => CountryResource::collection($this->whenLoaded('country')),
            "category" => CountryResource::collection($this->whenLoaded('category'))
        ];
    }
}
