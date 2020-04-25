<?php

use Illuminate\Database\Seeder;

class FixedValueCouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\FixedValueCoupon')->create();
    }
}
