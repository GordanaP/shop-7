<?php

namespace App;

use Illuminate\Support\Str;
use App\Traits\Product\Imageable;
use Illuminate\Database\Eloquent\Model;
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
}
