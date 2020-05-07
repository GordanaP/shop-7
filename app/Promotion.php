<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promotion extends Model
{
    protected $with = [ 'reduction' ];

    /**
     * Get the promotion by its code.
     *
     * @param  string $code
     */
    public static function findByCode($code)
    {
        return optional(static::firstWhere('code', $code));
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->as('valid')
            ->withPivot('from', 'to');
    }

    public function productsAtPresent()
    {
        return $this->products()
            ->wherePivot('from', '<', today())
            ->wherePivot('to', '>', today());
    }

    /**
     * The reduction type applying to promotion.
     */
    public function reduction(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * The apply the discount.
     *
     * @param  integer $price
     */
    public function applyDiscount($price): int
    {
        return $this->reduction->applyDiscount($price);
    }
}
