<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_lists', function (Blueprint $table) {
            $table->id();

            $table->timestamps();

            $table->decimal('price_sum_product', 10, 2)->unsigned();
            $table->bigInteger('count_product')->unsigned();

            $table->bigInteger('product_order_list_id')->unsigned();
            $table->foreign('product_order_list_id', 'product_order_list_fk')
                ->on('products')->references('id')
                ->onDelete('cascade');

            $table->bigInteger('order_order_list_id')->unsigned();
            $table->foreign('order_order_list_id', 'order_order_list_fk')
                ->on('orders')->references('id')
                ->onDelete('cascade');

            $table->boolean('is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_lists');
    }
};
