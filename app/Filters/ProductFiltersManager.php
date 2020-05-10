<?php

namespace App\Filters;

use App\Product;
use App\Filters\CategoryFilter;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Database\Eloquent\Builder;

class ProductFiltersManager
{
    /**
     * Apply the product filters.
     */
    public function apply(): Builder
    {
        return app(Pipeline::class)
            ->send(Product::query()
                ->with('images', 'currentPromotions', 'ratings'))
            ->through([
                CategoryFilter::class,
            ])
            ->thenReturn();
    }
}