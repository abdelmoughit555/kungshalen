<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        "title" => $title = $faker->sentence,
        "slug" => Str::slug($title, '-'),
        "description" => $faker->text,
        "price" => $faker->randomNumber(NULL, false) ,
        "image" => $faker->title,
    ];
});
