<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_rating', function (Blueprint $table) {

            $table->primary(['product_id', 'rating_id', 'user_id']);

            $table->foreignId('product_id')->constrained()
                ->onDelete('cascade');

            $table->foreignId('rating_id')->constrained()
                ->onDelete('cascade');

            $table->unsignedInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_rating');
    }
}
