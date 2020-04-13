<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User')->create([
            'name' => 'gordana',
            'email' => 'g@gmail.com'
        ]);

        factory('App\User')->create([
            'name' => 'darko',
            'email' => 'd@gmail.com'
        ]);
    }
}
