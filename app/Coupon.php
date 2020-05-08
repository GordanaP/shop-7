<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Coupon extends Model
{
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'reduction'
    ];

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
    public function reduction(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * The discount calculated on the basis of the coupon value.
     *
     * @param  integer $amount
     */
    public function applyDiscount($amount): int
    {
        return $this->reduction->getDiscount($amount);
    }

    /**
     * The coupon's name.
     *
     * @return string
     */
    public function name()
    {
        return $this->reduction->name;
    }
}
