<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('order_number');
            $table->string('stripe_payment_id')->unique();
            $table->unsignedInteger('total_in_cents');
            $table->unsignedInteger('subtotal_in_cents');
            $table->unsignedInteger('tax_amount_in_cents');
            $table->unsignedInteger('shipping_costs_in_cents');
            $table->datetime('payment_created_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
