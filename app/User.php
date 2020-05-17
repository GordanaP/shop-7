<?php

namespace App;

use App\Traits\User\HasAddress;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasAddress, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The user's customer profile.
     */
    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    /**
     * The user's orders.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * The user's shipping addresses.
     */
    public function shippings(): HasMany
    {
        return $this->hasMany(Shipping::class);
    }

    /**
     * The products rated by the given user.
     */
    public function ratedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_rating', 'user_id', 'product_id')
            ->withPivot('rating_id')
            ->as('rate');
    }

    /**
     * Determine if the user has rated any product.
     */
    public function hasRatedAnyProduct(): bool
    {
        return$this->ratedProducts->load('currentPromotions')->count();
    }

    /**
     * The user's favorite products.
     */
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'user_favorite', 'user_id', 'product_id');
    }

    /**
     * The user has any favorite product.
     */
    public function hasAnyFavorite(): bool
    {
        return $this->favorites->count();
    }

    /**
     * Determine if the user favorited the given product.
     *
     * @param  \App\Product  $product
     */
    public function hasFavorited($product): bool
    {
        return $this->favorites->load('currentPromotions')->where('id', $product->id)->first();
    }

    /**
     * The user toggles favoriting the product.
     *
     * @param  \App\Product $product
     */
    public function togglesFavoriting($product)
    {
        $this->favorites()->toggle($product->id);
    }
}
