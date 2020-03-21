<?php

use Illuminate\Database\Seeder;
use App\Models\Country;
use Faker\Factory;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::query()->delete();

        factory(Country::class, 200)->create();
    }
}
