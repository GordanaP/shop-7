<?php

namespace App\Utilities\General;

use Illuminate\Support\Str;

class Present
{
    /**
     * Present the price with the currency.
     *
     * @param  mixed $price_in_cents
     */
    public function price($price_in_cents): string
    {
        return Str::price(number_format($price_in_cents / 100, 2));
    }

    /**
     * Present the tax rate in percents.
     */
    public function taxRate(): string
    {
        return (config('cart.tax_rate') * 100).'%';
    }

    /**
     * Present the discount.
     *
     * @param  mixed $discount
     */
    public function discount($discount):string
    {
        return '-'.$discount;
    }

    /**
     * The promotion name and value.
     *
     * @param  \App\Product
     */
    public function promotionFullName($product): string
    {
        return optional($product->currentPromotion())->name()
        .' '. optional($product->currentPromotion())->code;
    }

    public function rating($rating)
    {
        return $rating.'/5';
    }
}
