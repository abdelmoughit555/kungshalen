<?php

namespace App\Cart;

use App\Models\Product;

class Cart {

    private $visitor;
    public function __construct($visitor)
    {
        $this->visitor = $visitor;
    }

    public function visitor()
    {
        return $this->visitor;
    }

    public function add(Product $product, $quantity)
    {
        return  $this->visitor->products()
            ->syncWithoutDetaching([
                $product->id =>
                [
                    'quantity' => $quantity + $this->getCurrentQuantity($product->id),
                    'price' => $product->price,
                ]
            ]);
    }

    public function update($products)
    {
        collect($products)->each(function ($product) {
            $this->visitor->products()->updateExistingPivot($product["id"], [
                'quantity' => $product["quantity"],
            ]);
        });
    }

    public function delete($productId = null)
    {
        $this->visitor->products()->detach($productId);
    }

    protected function getCurrentQuantity($productId)
    {
        if ($product = $this->visitor->products->where('id', $productId)->first()) {
            return $product->pivot->quantity;
        }

        return 0;
    }
}
