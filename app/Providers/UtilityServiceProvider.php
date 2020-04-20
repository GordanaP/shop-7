<?php

namespace App\Providers;

use App\Utilities\General\CountryList;
use Illuminate\Support\ServiceProvider;
use App\Utilities\Products\ShoppingCart;
use App\Utilities\Payments\StripeGateway;
use App\Utilities\Payments\AmountCollected;

class UtilityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->instance('country-list', new CountryList);
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
