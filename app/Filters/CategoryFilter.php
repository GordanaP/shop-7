<?php

namespace App\Filters;

use App\Filters\CustomFilter;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends CustomFilter
{
    /**
     * The filter name.
     *
     * @var string
     */
    protected $filterName = 'category';

    /**
     * Apply the filter.
     */
    protected function applyFilter(): Builder
    {
        return $this->builder->whereHas('categories', function($query) {
            $query->where('name', request($this->filterName));
        });
    }
}