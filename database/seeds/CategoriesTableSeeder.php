<?php

use App\Product;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::inRandomOrder()->get();

        factory('App\Category', 5)->create()
            ->map(function($category) use ($products) {
                $category->products()
                    ->sync($products->take(rand(4, 10)));
            });
    }
}
