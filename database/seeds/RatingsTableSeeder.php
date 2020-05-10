<?php

use App\User;
use App\Rating;
use App\Product;
use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 6 ; $i++) {
            factory('App\Rating')->create([
                'star' => $i
            ]);
        }

        Product::inRandomOrder()->take(10)->get()
            ->map(function($product){
                $product->ratings()->save(
                    Rating::inRandomOrder()->first(), [
                        'user_id' => User::inRandomOrder()
                            ->get()
                            ->unique()
                            ->first()
                            ->id
                    ]
                );
            });
    }
}
