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

        $product->subtotal_in_cents = $product->price_in_cents * $product->quantity;

        $product->subtotal_in_dollars = number_format($product->subtotal_in_cents/100, 2);

        return $product->load('images');
    }

}