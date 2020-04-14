<?php

namespace App\Utilities\Payments;

use Illuminate\Support\Facades\App;

class AmountCollected
{
    public function __construct()
    {
        $this->shopping_cart = App::make('shopping-cart');
    }

    public function inCents()
    {
        return [
            'total' => $this->shopping_cart->totalInCents(),
            'subtotal' => $this->shopping_cart->subtotalInCents(),
            'tax' => $this->shopping_cart->taxAmountInCents(),
            'shipping_costs' => $this->shopping_cart->shippingCostsInCents(),
        ];
    }

}