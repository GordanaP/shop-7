<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
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
        Str::macro('withCurrency', function ($price) {
            $currency = config('cart.currency');

            return Str::of($price)->prepend($currency);
        });

        Str::macro('price', function ($price) {
            $currency = config('cart.currency');

            return Str::of($price)->prepend($currency);
        });

        Str::macro('reverseSlug', function ($slug) {
            return Str::of($slug)
                ->replace('-', ' ')
                ->ucfirst();
        });

        Str::macro('toList', function ($item, $loop) {
            $punctuation_mark = ',';

            return Str::of($item)
                ->ucfirst()
                ->append(! $loop->last ? $punctuation_mark : '');
        });
    }
}
