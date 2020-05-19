<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
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
        Blade::if('authNotRated', function ($product) {
            return Auth::check() && ! $product->isRatedByUser(Auth::user());
        });

        Blade::if('hasDefault', function () {
            return Auth::check() && Auth::user()->findDefaultShipping()->isNotEmpty();
        });

        Blade::if('hasNoDefault', function(){
            return (Auth::check() && Auth::user()->findDefaultShipping()->isEmpty()) || Auth::guest();
        });

    }
}
