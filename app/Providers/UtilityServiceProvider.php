<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Utilities\Products\ShoppingCart;

class UtilityServiceProvider extends ServiceProvider
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
        $this->app->bind('ShoppingCart', function($app){
            return session('cart', new ShoppingCart);
        });
    }
}
