<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the product "created" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        $product->country()->attach(request()->country);
        $product->category()->attach(request()->category);
    }

    public function creating(Product $product)
    {
        $product->image = $product->imageable();
        $product->slug = Str::slug($product->title, '-');
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        $product->updateImageable();
    }

    public function updated(Product $product)
    {
        $product->country()->sync(request()->country);
        $product->category()->sync(request()->category);
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $product->country()->detach();
        $product->category()->detach();
    }
}
