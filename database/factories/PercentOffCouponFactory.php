<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PercentOffCoupon;
use Faker\Generator as Faker;

$factory->define(PercentOffCoupon::class, function (Faker $faker) {
    return [
        'percent_off' => 10
    ];
});
