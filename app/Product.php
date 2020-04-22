<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
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
     * The product's images.
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
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

    /**
     * Determine if the product has any image.
     *
     * @return boolean
     */
    public function hasImage(): Collection
    {
        return $this->images;
    }

    /**
     * Get the product's image.
     */
    public function getImage($image): string
    {
        return $this->hasImage()
            ? App::make('product-image')->getUrl($image) : '';
    }

    public function getDefaultImage(): string
    {
        $default = $this->images->where('is_default', true)->first();

        return $default
            ? App::make('product-image')->getUrl($default)
            : asset('images/demo_product.jpg');
    }

    // /**
    //  * Get the route key for the model.
    //  */
    // public function getRouteKeyName(): string
    // {
    //     return 'slug';
    // }
}
