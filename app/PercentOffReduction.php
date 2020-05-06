<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PercentOffReduction extends Model
{
    /**
     * The discount.
     *
     * @param  integer $amount
     */
    public function discount($amount): int
    {
        return round($amount * ($this->percent_off / 100));
    }

    /**
     * The coupon value.
     *
     * @return string
     */
    public function value()
    {
        return $this->percent_off . '% off';
    }

    // public function coupons()
    // {
    //     return $this->hasMany(Coupon::class);
    // }
}
