<?php

use Illuminate\Database\Seeder;

class PromotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Promotion')->create();

        factory('App\Promotion')->create([
            'name' => 'Weekend Promotion',
            'code' => 'VPPO10',
            'reduction_type' => 'App\PercentOffReduction',
            'reduction_id' => '2',
        ]);

        factory('App\Promotion')->create([
            'name' => 'Weekend Promotion',
            'code' => 'VPPO15',
            'reduction_type' => 'App\PercentOffReduction',
            'reduction_id' => '3',
        ]);

        factory('App\Promotion')->create([
            'name' => 'Month Promotion',
            'code' => 'MPPO05',
            'reduction_type' => 'App\PercentOffReduction',
            'reduction_id' => '1',
        ]);
    }
}
