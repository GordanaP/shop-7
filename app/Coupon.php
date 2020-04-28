<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Coupon extends Model
{
    /**
     * Get the coupon by its code.
     *
     * @param  string $code
     */
    public static function findByCode($code): ?Coupon
    {
        return static::firstWhere('code', $code);
    }

    /**
     * The model owning the coupon.
     */
    public function coupon(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * The discount.
     *
     * @param  integer $amount
     */
    public function discount($amount): int
    {
        return $this->load('coupon')->coupon->discount($amount);
    }
}
