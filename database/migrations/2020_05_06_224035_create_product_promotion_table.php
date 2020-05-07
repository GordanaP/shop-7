<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_promotion', function (Blueprint $table) {
            $table->primary(['product_id', 'promotion_id', 'from']);

            $table->foreignId('product_id')->constrained()
                ->onDelete('cascade');

            $table->foreignId('promotion_id')->constrained()
                ->onDelete('cascade');

            $table->datetime('from');
            $table->datetime('to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_promotion');
    }
}
