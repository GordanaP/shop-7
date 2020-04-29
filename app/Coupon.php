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
        return optional(static::firstWhere('code', $code))->load('coupon');
    }

    /**
     * The model owning the coupon.
     */
    public function coupon(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * The discount calculated on the basis of the coupon value.
     *
     * @param  integer $amount
     */
    public function discount($amount): int
    {
        return $this->coupon->discount($amount);
    }

    /**
     * The coupon's value.
     *
     * @return string
     */
    public function value()
    {
        return $this->code . ' - ' . $this->coupon->value();
    }
}
