<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FixedValueReduction;
use Faker\Generator as Faker;

$factory->define(FixedValueReduction::class, function (Faker $faker) {
    return [
        'value_in_cents' => 500
    ];
});
