<?php

namespace App\Traits\ShoppingCart;

use App\Coupon;

trait HasCoupon
{
    public function addCoupon($discount)
    {
        $this->put('coupon', $discount);

        $this->save();
    }

    public function discount()
    {
        return optional(Coupon::findByCode($this->get('coupon')))
            ->discount($this->subtotalInCents());;
    }

}
