<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Product\ProductResource;

class CartProductResource extends ProductResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'quantity' => $this->pivot->quantity,
            'price' => $this->getPrice()
        ]);
    }

    protected function getPrice()
    {
        return $this->formattedPrice(
            $this->pivot->quantity * $this->price
        );
    }
}
