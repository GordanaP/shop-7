<?php

namespace App\Filters;

use App\Product;
use App\Filters\CategoryFilter;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Database\Eloquent\Builder;

class ProductFilterService
{
    /**
     * Apply the product filters.
     */
    public function apply(): Builder
    {
        return app(Pipeline::class)
            ->send(Product::query())
            ->through([
                CategoryFilter::class,
            ])
            ->thenReturn();
    }
}