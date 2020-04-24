<?php

namespace App\Traits\Product;

use App\Image;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Imageable
{
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
     * Get the product's main image.
     */
    public function mainImage(): string
    {
        if($main = $this->isMainImage()) {
            $image = App::make('image-manager')->getUrl($main);
        } else {
            $image = ($first = $this->images->first())
                ? App::make('image-manager')->getUrl($first)
                : asset('images/demo_product.jpg');
        }

        return $image;
    }

    /**
     * Get the product's thumbnail image.
     */
    public function thumbnailImage($image): string
    {
        return App::make('image-manager')->getUrl($image) ?? null;
    }

    /**
     * Determine if the product has the main image.
     */
    public function isMainImage(): ?Image
    {
        return $this->images->firstWhere('is_main', true);
    }
}
