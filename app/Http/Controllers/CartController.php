<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart\Cart;
use App\Models\Product;
use App\Http\Resources\Cart\CartResource;

class CartController extends Controller
{
    public function index(Cart $cart)
    {
        return new CartResource($cart->visitor());
    }

    public function store(Request $request, Product $product, Cart $cart)
    {
        return $cart->add($product, $request->quantity);
    }

    public function update(Request $request, Cart $cart)
    {
        return $cart->update($request->products);
    }

    public function destroy(Request $request, Cart $cart)
    {
        return $cart->delete($request->productId);
    }
}
