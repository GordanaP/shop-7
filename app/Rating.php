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
        return $this->belongsToMany(Product::class)
            ->as('user')
            ->withPivot('user_id');
    }
}
