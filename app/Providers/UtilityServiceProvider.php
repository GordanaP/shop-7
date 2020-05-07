<?php

namespace App\Providers;

use App\Utilities\General\Present;
use App\Utilities\General\CountryList;
use App\Utilities\Images\ImageManager;
use App\Utilities\General\QueryManager;
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
        $this->app->instance('image-manager', new ImageManager);

        $this->app->bind('Present', function($app) {
            return new Present;
        });

        $this->app->bind('QueryManager', function($app) {
            return new QueryManager;
        });

        $this->app->bind('ShoppingCart', function($app){
            return session('cart', new ShoppingCart);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
