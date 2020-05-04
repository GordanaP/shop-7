<?php

namespace App;

use Illuminate\Support\Str;
use App\Traits\Product\Imageable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use Imageable;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['price_in_dollars'];

    /**
     * The number of models to return for pagination.
     *
     * @var  int
     */
    protected $perPage = 9;

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

    public function orderPrice($price_in_cents)
    {
        $purchase_price = number_format($price_in_cents / 100, 2);

        return Str::price($purchase_price);
    }

    public function orderSubtotal($price_in_cents, $qty)
    {
        $subtotal_in_dollars = number_format(($price_in_cents * $qty / 100), 2);

        return Str::price($subtotal_in_dollars);
    }

    /**
     * The orders containing the products.
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
            ->as('ordered')
            ->withPivot('quantity', 'price_in_cents');
    }

    /**
     * The categories containing the products.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Scope a query to only include the products fitered by a query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \App\Filters\ProductFiltersManager  $productFiltersManager
     */
    public function scopeFilter($query, $productFiltersManager): Builder
    {
        return $productFiltersManager->apply($query);
    }
}
