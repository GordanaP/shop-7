<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Coupon extends Model
{
    protected $with = ['coupon'];

    /**
     * Get the coupon by its code.
     *
     * @param  string $code
     */
    public static function findByCode($code)
    {
        return optional(static::firstWhere('code', $code));
    }

    /**
     * The orders to which the coupon has been applied.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
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
