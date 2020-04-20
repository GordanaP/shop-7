<?php

namespace App\Utilities\General;

class CustomArray
{
    /**
     * The array.
     *
     * @var array
     */
    public $all = [];

    /**
     * The array's values.
     */
    public function values(): array
    {
        return array_values($this->all);
    }

    /**
     * The key for the specific array's value.
     *
     * @param  string $value
     */
    public function key($value): string
    {
        return array_search($value, $this->all);
    }
}