<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PercentOffCoupon extends Model
{
    /**
     * The discount.
     *
     * @param  integr $amount
     */
    public function discount($amount): int
    {
        return $amount * ($this->percent_off / 100);
    }
}
