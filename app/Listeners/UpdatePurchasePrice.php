<?php

namespace App\Listeners;

use App\Coupon;
use App\Events\CouponApplied;
use App\Facades\ShoppingCart;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdatePurchasePrice
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CouponApplied  $event
     * @return void
     */
    public function handle(CouponApplied $event)
    {
        $coupon = Coupon::findByCode($event->coupon_code);

        $discount = $coupon->discount(ShoppingCart::subtotalInCents());

        \App::make('shopping-cart')->setDiscount($discount);

         // dd(\App::make('shopping-cart')->discount);
    }
}
