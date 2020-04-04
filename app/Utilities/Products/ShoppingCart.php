<?php

namespace App\Utilities\Products;

use App\Product;
use Illuminate\Support\Collection;
use App\Utilities\Products\CartItem;

class ShoppingCart extends Collection
{
    /**
     * Add the item to the cart.
     *
     * @param \App\Product  $product
     * @param integer $qty
     */
    public function add($product, $qty = 1)
    {
        $totalQty = $this->totalQuantity($product, $qty);

        $item = $this->cartItem($product, $totalQty);

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
        $item = $this->cartItem($product, $qty);

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
     * The cart's content.
     */
    public function content(): Collection
    {
        return $this->values();
    }

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

    /**
     * The cart item.
     *
     * @param  \App\Product $product
     * @param  integer $qty
     */
    protected function cartItem($product, $qty): Product
    {
        return (new CartItem)->createFrom($product, $qty);
    }
}
