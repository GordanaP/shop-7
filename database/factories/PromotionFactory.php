<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Promotion;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Promotion::class, function (Faker $faker) {
    return [
        'name' => 'Weekend Promotion',
        'code' => 'DEF246',
        'reduction_type' => 'App\PercentOffReduction',
        'reduction_id' => '1',
        'starts_at' => Carbon::today()->subDay(1),
        'ends_at' => Carbon::today()->addDays(3),
    ];
});
