<?php

namespace App\Utilities\Products;

use App\Product;
use Illuminate\Support\Collection;
use App\Utilities\Products\CartItem;
use App\Traits\ShoppingCart\HasCoupon;
use App\Traits\ShoppingCart\Priceable;

class ShoppingCart extends Collection
{
    use HasCoupon, Priceable;

    /**
     * The discount.
     *
     * @var integer
     */
    public static $discount;

    /**
     * Set the discount.
     *
     * @param integer $discount
     */
    public static function setDiscount($discount)
    {
        static::$discount = $discount;
    }

    /**
     * Get the discount.
     *
     * @return [type] [description]
     */
    public static function getDiscount(): ?float
    {
        return number_format (static::$discount / 100, 2 );
    }

    /**
     * Add the item to the cart.
     *
     * @param \App\Product  $product
     * @param integer $qty
     */
    public function add($product, $qty = 1)
    {
        $totalQty = $this->totalQuantity($product, $qty);

        $item = (new CartItem)->from($product, $totalQty);

        $this->put($product->id, $item);

        $this->save();
    }

    /**
     * Update the item's quantity.
     *
     * @param  \App\Product $product
     * @param  integer $qty
     */
    public function update($product, $qty)
    {
        $item = (new CartItem)->from($product, $qty);

        $this->put($product->id, $item);

        $this->save();
    }

    /**
     * Remove the item from the cart.
     *
     * @param  integer $productId
     */
    public function remove($productId)
    {
        $this->forget($productId);

        $this->save();
    }

    /**
     * Remove all items from the cart.
     */
    public function empty()
    {
        session()->forget('cart');
    }

    /**
     * Determine if there is any item in the cart.
     */
    public function isNotEmpty(): bool
    {
        return $this->itemsCount() > 0;
    }

    /**
     * Get the # number of cart items.
     */
    public function itemsCount(): int
    {
        return $this->sum('quantity');
    }

    /**
     * The cart's content.
     */
    public function content(): Collection
    {
        return $this->except('coupon')->values();
    }

    // public function coupon()
    // {
    //     return $this->only('coupon');
    // }



    /**
     * Update the cart's content;
     */
    private function save()
    {
        session()->put('cart', $this);
    }

    /**
     * The item's total quantity = new qty + previous qty.
     *
     * @param  App\Product $product
     * @param  integer $qty
     */
    protected function totalQuantity($product, $qty): int
    {
        return $qty + $this->quantity($product);
    }

    /**
     * The item's quantity.
     *
     * @param  \App\Product $product
     */
    protected function quantity($product): int
    {
        return optional($this->get($product->id))->quantity ?? 0;
    }

}
