<?php

use Illuminate\Database\Seeder;

class PercentOffCouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\PercentOffCoupon')->create();
    }
}
