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
    public function from($product, $quantity): Product
    {
        $product->quantity = $quantity;

        $product->subtotal_in_cents = $product->calculated_price_in_cents * $product->quantity;

        return $product->load('images');
    }

}