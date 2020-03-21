<?php

namespace App\Http\Controllers;
use App\Models\{Product, Country, Category};
use App\Http\Resources\Product\ProductIndexClient;
use App\Http\Resources\Country\CountryResource;
use App\Http\Resources\Category\CategoryResource;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = Product::with(['country', 'category'])
                ->withScopes()
                ->paginate(10);

        $countries = Country::withScopes()->get();

        $subCategory = Category::withScopes()->get();

        return response()->json([
            'subCategory' => CategoryResource::collection($subCategory),
            'products' => ProductIndexClient::collection($products),
            'countries' => CountryResource::collection($countries),
        ]);
    }
}
