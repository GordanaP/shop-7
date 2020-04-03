<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $appends = ['price_in_dollars'];


    /**
     * Get the product price together with currency.
     */
    public function getPriceAttribute(): string
    {
        return Str::price_in_dollars($this->price_in_dollars);
    }

    /**
     * Get the product's price in dollars.
     *
     * @return float
     */
    public function getPriceInDollarsAttribute()
    {
        $price_in_dollars = $this->price_in_cents/100;

        return number_format($this->price_in_cents/100, 2);
    }
}
