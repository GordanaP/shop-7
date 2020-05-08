<?php

namespace App\Utilities\General;

use Illuminate\Support\Str;

class Present
{
    /**
     * Present price with the currency.
     *
     * @param  mixed $price_in_cents
     */
    function price($price_in_cents): string
    {
        return Str::price(number_format($price_in_cents / 100, 2));
    }

    /**
     * Present tax rate in percents.
     */
    function taxRate(): string
    {
        return (config('cart.tax_rate') * 100).'%';
    }

    /**
     * Present discount.
     *
     * @param  mixed $discount [description]
     */
    function discount($discount):string
    {
        return '-'.$discount;
    }
}
