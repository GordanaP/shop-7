<?php

namespace App\Utilities\General;

use Illuminate\Support\Str;

class Present
{
    function price($price_in_cents)
    {
        return Str::price(number_format($price_in_cents / 100, 2));
    }

    function taxRate()
    {
        return (config('cart.tax_rate') * 100).'%';
    }

    function discount($discount)
    {
        return '-'.$discount;
    }
}