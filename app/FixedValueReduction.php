<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixedValueReduction extends Model
{
    /**
     * Get the discount.
     *
     * @param  integer $amount
     */
    public function getDiscount($amount): int
    {
        return $this->value_in_cents;
    }

    /**
     * Apply the discount.
     *
     * @param  integer $price_in_cents
     */
    public function applyDiscount($price_in_cents)
    {
        return $price_in_cents - $this->value_in_cents;
    }
}
