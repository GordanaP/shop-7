<?php

use App\User;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Customer')->create([
            'name' => 'goca',
            'street_address' => 'street one 22',
            'postal_code' => '11000',
            'city' => 'Belgrade',
            'country' => 'RS',
            'email' => "g@test.com",
            'phone' => '123456',
            'user_id' => User::first()->id,
        ]);
    }
}
