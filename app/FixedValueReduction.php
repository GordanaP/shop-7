<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixedValueReduction extends Model
{
    /**
     * The discount.
     *
     * @param  integer $amount
     */
    public function discount($amount): int
    {
        return $this->value_in_cents;
    }

    public function applyDiscount($price_in_cents)
    {
        return $price_in_cents - $this->value_in_cents;
    }

    /**
     * The coupon value.
     *
     * @return string
     */
    public function value()
    {
        return 'value coupon';
    }
}
