<?php

namespace App\Utilities\Products;

use App\Product;

class CartItem
{
    /**
     * Create a cart item from a product and a quantity.
     *
     * @param  \App\Product $product
     * @param  integer $quantity
     */
    public function createFrom($product, $quantity): Product
    {
        $product->quantity = $quantity;

        $product->subtotal_in_cents = $product->price_in_cents * $product->quantity;

        return $product;
    }

}