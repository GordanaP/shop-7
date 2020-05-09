<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Promotion;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Promotion::class, function (Faker $faker) {
    return [
        'name' => 'Weekend Promotion',
        'code' => 'WPPO05',
        'reduction_type' => 'App\PercentOffReduction',
        'reduction_id' => '1',
    ];
});
