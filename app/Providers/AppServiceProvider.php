<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Cart\Cart;
use App\Models\Visitor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Cart::class, function ($app) {

            $ip = Visitor::firstOrCreate(
                    ['ip' => $app->request->ip()]
                );

            return new Cart($ip);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
