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
        Product::unsetEventDispatcher();

        $products = factory(Product::class, 100)->create();
        $faker = Factory::create();
        $categoryCount = Category::count();
        $countryCount = Country::count();

        $products->each(function ($product) use ($faker, $categoryCount, $countryCount) {
            $product->category()->attach($faker->numberBetween(1, $categoryCount));
            $product->country()->attach($faker->numberBetween(1, $countryCount));
        });
    }
}
