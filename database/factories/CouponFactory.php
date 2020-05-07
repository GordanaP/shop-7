<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Coupon;
use Faker\Generator as Faker;

$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'code' => 'PO10',
        'reduction_type' => 'App\PercentOffReduction',
        'reduction_id' => '1',
        'valid_from' => '2020-05-05',
        'expires_at' => '2020-05-15',
    ];
});
