<?php

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

abstract class CustomFilter
{
    /**
     * The filter name.
     *
     * @var string
     */
    protected $filterName;

    /**
     * The query builder.
     *
     * @var \Illuminate\Database\Eloquent\Builder $builder
     */
    protected $builder;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Support\Request  $request
     * @param  Closure $next
     */
    public function handle($request, Closure $next): Builder
    {
        $this->builder = $next($request);

        if(! request()->has($this->filterName)) {
            return $next($request);
        }

        return $this->applyFilter();
    }

    /**
     * Apply the filter.
     */
    protected abstract function applyFilter();
}
