<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rating extends Model
{
    /**
     * Get all the products for the rating.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_user', 'rating_id', 'product_id')
            ->withPivot('user_id')
            ->as('user');
    }
}
