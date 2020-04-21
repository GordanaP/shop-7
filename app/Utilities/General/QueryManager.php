<?php

namespace App\Utilities\General;

use Illuminate\Support\Arr;

class QueryManager
{
    /**
     * The query string.
     *
     * @var array
     */
    protected $query;

    /**
     * Construct a new class instance.
     *
     * @param array $query
     */
    public function __construct()
    {
        $this->query = request()->query();
    }

    /**
     * Create the query string.
     *
     * @param  array  $query
     */
    public function build(array $query): array
    {
        $queryString = array_merge( $this->query, $query);

        return Arr::except($queryString, ['page']);

    }

    /**
     * Remove the query string.
     *
     * @param  string $filter
     */
    public function remove($filter): array
    {
        return request()->except([$filter, 'page']);
    }

    /**
     * Detects specific active filters.
     *
     * @param  array $filter
     */
    public function detects($filter): ?bool
    {
        return request($filter);
    }

    /**
     * Detects any active filter,
     *
     * @param  array $filters
     */
    public function detectsAny($filters): bool
    {
        return collect($this->query)->intersectByKeys($filters)->all();
    }

    /**
     * Make active class.
     *
     * @param  string $key
     * @param  string $filter
     */
    public function makeActiveClass($key, $filter): ?string
    {
        return request($filter) || request($filter) == '0'
            ? active($key, request($filter)) : '';
    }
}