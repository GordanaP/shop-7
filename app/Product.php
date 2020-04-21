<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $appends = ['price_in_dollars'];


    /**
     * Get the product price together with currency.
     */
    public function getPriceAttribute(): string
    {
        return Str::withCurrency($this->price_in_dollars);
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

    /**
     * The orders containing the product.
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
            ->as('ordered')
            ->withPivot('quantity', 'price_in_cents');
    }

    /**
     * The categories containing the product.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    // /**
    //  * Get the route key for the model.
    //  */
    // public function getRouteKeyName(): string
    // {
    //     return 'slug';
    // }
}
