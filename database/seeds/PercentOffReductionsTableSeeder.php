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
    }
}
