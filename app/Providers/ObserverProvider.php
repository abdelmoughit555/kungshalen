<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{Product,Category,Country};
use App\Observers\{ProductObserver,CategoryObserver,CountryObserver};

class ObserverProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(ProductObserver::class);
        Category::observe(CategoryObserver::class);
        Country::observe(CountryObserver::class);
    }
}
