<?php

namespace App\Traits\Product;

use App\Promotion;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


trait Promotionable
{
    /**
     * Get all the promotions applied to the products.
     */
    public function promotions(): BelongsToMany
    {
        return $this->belongsToMany(Promotion::class)
            ->as('valid')
            ->withPivot('from', 'to');
    }

    /**
     * Get the product's current promotions.
     */
    public function currentPromotions(): BelongsToMany
    {
        return $this->promotions()
            ->wherePivot('from', '<', today())
            ->wherePivot('to', '>', today());
    }

    /**
     * Get the product's current promotion.
     */
    public function currentPromotion(): ?Promotion
    {
        return $this->currentPromotions->first();
    }

    /**
     * Determine if the product is currently being promoted.
     */
    public function isCurrentlyBeingPromoted()
    {
        return $this->currentPromotions->count();
    }
}
