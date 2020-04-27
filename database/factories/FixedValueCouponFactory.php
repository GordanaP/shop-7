<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FixedValueCoupon;
use Faker\Generator as Faker;

$factory->define(FixedValueCoupon::class, function (Faker $faker) {
    return [
        'value_in_cents' => 500
    ];
});
