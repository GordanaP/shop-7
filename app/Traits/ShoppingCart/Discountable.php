<?php

namespace App\Traits\ShoppingCart;

use App\Coupon;

trait Discountable
{
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
     */
    public static function getDiscount(): ?float
    {
        return static::$discount /100;
    }

    /**
     * Calculate the discount.
     *
     * @return mixed
     */
    public function coupon()
    {
        $coupon = Coupon::findByCode($this->get('coupon'));;
        $amount = $this->subtotalInCents();

        return [
            'discount' => optional($coupon)->discount($amount),
            'value' => optional($coupon)->value(),
        ];
    }

    /**
     * Add the coupon to the cart.
     *
     * @param string $code
     */
    public function addCoupon($code)
    {
        $this->put('coupon', $code);

        $this->save();
    }
}
