<?php

namespace App\Traits\Product;

use App\User;
use App\Rating;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Rateable
{
    /**
     * Get all the ratings for the product.
     */
    public function ratings(): BelongsToMany
    {
        return $this->belongsToMany(Rating::class, 'product_rating')
            ->withPivot('user_id')
            ->as('user');
    }

    /**
     * The users who rated the product.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'product_rating')
            ->withPivot('rating_id')
            ->as('rate');
    }

    /**
     * Get the product's average rating;
     */
    public function avgRating(): int
    {
        return number_format($this->ratings->pluck('rate')->avg());
    }

    /**
     * Toggle between rating the product and updating the rating.
     *
     * @param  App\User $user
     * @param  integer $rating
     */
    public function toggleUserRating($user, $rating)
    {
        $this->isRatedByUser($user)
            ? $this->updateUserRating($user, $rating)
            : $this->getRatingFromUser($user, $rating);
    }

    /**
     * The user's rating.
     *
     * @param  \App\User $user
     */
    public function userRating($user): ?int
    {
        return optional($this->ratings
            ->where('user.user_id', optional($user)->id)
            ->first())->rate;
    }

    /**
     * Deteremine if the product is rated by the user.
     *
     * @param  App\User|null  $user
     */
    public function isRatedByUser($user = null): bool
    {
        return $user
            ? $this->ratings->pluck('user.user_id')->contains($user->id)
            : '';
    }

    /**
     * Deteremine if the product is rated by any user.
     */
    public function isRatedByAnyUser(): bool
    {
        return $this->avgRating() > 0;
    }

    /**
     * Get the rating from the given user.
     *
     * @param  \App\User $user
     * @param  integer $rating
     */
    private function getRatingFromUser($user, $rating)
    {
        $this->users()->save(
            User::find($user->id), [
                'rating_id' => $rating
            ]
        );
    }

    /**
     * Update the user's rating.
     *
     * @param  App\User $user
     * @param  integer $rating
     */
    private function updateUserRating($user, $rating)
    {
        $this->users()->updateExistingPivot($user->id, [
            'rating_id' => $rating
        ]);
    }
}
