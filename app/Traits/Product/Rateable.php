<?php

namespace App\Traits\Product;

use App\Rating;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Rateable
{
    /**
     * Get all the ratings for the product.
     */
    public function ratings(): BelongsToMany
    {
        return $this->belongsToMany(Rating::class)
            ->as('user')
            ->withPivot('user_id');
    }

    /**
     * Get the product's average rating;
     */
    public function avgRating(): int
    {
        return number_format($this->ratings->pluck('star')->avg());
    }

    /**
     * Get the rating from the given user.
     *
     * @param  int $rating
     * @param  \App\User $user
     */
    public function getRatingFrom($rating, $user): void
    {
        $this->ratings()->save(
            Rating::find($rating), [
                'user_id' => $user->id
            ]
        );
    }

    /**
     * The user rating.
     *
     * @param  \App\User $user
     */
    public function userRating($user): int
    {
        return optional($this->ratings
            ->where('user.user_id', $user->id)
            ->first())->star;
    }

    /**
     * Deteremine if the product is rated by the user.
     *
     * @param  App\User  $user
     */
    public function isRatedByUser($user = null): bool
    {
        return $user
            ? $this->ratings->pluck('user.user_id')->contains($user->id)
            : '';
    }

}