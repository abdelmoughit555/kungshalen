<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Country;
use Faker\Factory;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::query()->delete();

        $products = factory(Product::class, 10000)->create();
        $faker = Factory::create();

        $products->each(function ($product) use ($faker) {
            $product->category()->attach($faker->numberBetween(1, Category::count()));
            $product->country()->attach($faker->numberBetween(1, Country::count()));
        });
    }
}
