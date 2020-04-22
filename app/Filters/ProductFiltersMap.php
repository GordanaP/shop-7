<?php

namespace App\Filters;

use App\Category;

class ProductFiltersMap
{
    /**
     * The product filters' map.
     */
    public static function filters(): array
    {
        return [
            'category' =>  Category::withCount('products')
                ->orderBy('products_count', 'desc')
                ->pluck('products_count', 'slug'),
        ];
    }
}