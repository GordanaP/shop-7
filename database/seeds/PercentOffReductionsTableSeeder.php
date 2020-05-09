<?php

use Illuminate\Database\Seeder;

class PercentOffReductionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\PercentOffReduction')->create();

        factory('App\PercentOffReduction')->create([
            'name' => '-10%',
            'percent_off' => 10
        ]);

        factory('App\PercentOffReduction')->create([
            'name' => '-15%',
            'percent_off' => 15
        ]);

    }
}
