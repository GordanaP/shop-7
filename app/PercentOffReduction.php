<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PercentOffReduction extends Model
{
    /**
     * Get the discount.
     *
     * @param  integer $amount
     */
    public function getDiscount($amount): int
    {
        return round($amount * ($this->percent_off / 100));
    }

    /**
     * Apply the discount.
     *
     * @param  integer $price
     */
    public function applyDiscount($price)
    {
        return round($price * (1 - $this->percent_off / 100));
    }

    /**
    * Get all of the reduction's pormotions.
    */
   public function promotions()
   {
       return $this->morphMany('App\Promotion', 'reduction');
   }

    /**
    * Get all of the reduction's coupons.
    */
   public function coupons()
   {
       return $this->morphMany('App\Coupon', 'reduction');
   }
}
