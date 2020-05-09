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

        if($product->isCurrentlyBeingPromoted()) {
            $product->subtotal_in_cents =
                $product->promotional_price_in_cents * $product->quantity;
            $product->promotion_id = $product->currentPromotion()->id;
        } else {
            $product->subtotal_in_cents =
                $product->price_in_cents * $product->quantity;
        }

        return $product->load('images');
    }

}