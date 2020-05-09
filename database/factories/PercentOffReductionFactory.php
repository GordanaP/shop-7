<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PercentOffReduction;
use Faker\Generator as Faker;

$factory->define(PercentOffReduction::class, function (Faker $faker) {
    return [
        'name' => '-5%',
        'percent_off' => 5
    ];
});
