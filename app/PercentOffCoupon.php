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
        return round($amount * ($this->percent_off / 100));
    }
}
