<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->sentence($nbWords = 3, $variableNbWords = true),
        'slug' => Str::slug($title),
        'subtitle' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'description' => $faker->paragraph,
        'price_in_cents' => random_int(500, 5000),
    ];
});
