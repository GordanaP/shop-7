<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixedValueCoupon extends Model
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

    /**
     * The coupon value.
     *
     * @return string
     */
    public function value()
    {
        return 'fixed value';
    }
}
