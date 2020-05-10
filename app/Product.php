<?php

namespace App;

use App\Promotion;
use App\Traits\Product\Imageable;
use App\Traits\Product\Promotionable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use Imageable, Promotionable;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'promotional_price_in_cents'
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var  int
     */
    protected $perPage = 9;


    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getPromotionalPriceInCentsAttribute()
    {
            return optional($this->currentPromotion())
                ->applyDiscount($this->price_in_cents);
    }

    /**
     * The orders containing the products.
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
            ->as('ordered')
            ->withPivot(
                'quantity',
                'price_in_cents',
                'promotional_price_in_cents',
                'promotion_id'
            );
    }

    /**
     * The categories containing the products.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

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
     * Get the product's current promotions.
     */
    public function userRatings(): BelongsToMany
    {
        return $this->ratings()
            ->wherePivot('user_id', '=', \Auth::id());
    }

    public function currentRating()
    {
        return $this->userRatings->first();
    }
    /**
     * Scope a query to only include the products fitered by a query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \App\Filters\ProductFiltersManager  $productFiltersManager
     */
    public function scopeFilter($query, $productFiltersManager): Builder
    {
        return $productFiltersManager->apply($query);
    }
}
