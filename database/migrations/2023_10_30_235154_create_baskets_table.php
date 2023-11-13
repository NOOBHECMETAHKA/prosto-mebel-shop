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
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();

            $table->integer("count_product")->unsigned()->autoIncrement();

            $table->bigInteger('user_basket_id')->unsigned();
            $table->foreign('user_basket_id', 'user_basket_fk')
                ->on('users')->references('id')
                ->onDelete('cascade');

            $table->bigInteger('product_basket_id')->unsigned();
            $table->foreign('product_basket_id', 'product_basket_fk')
                ->on('products')->references('id')
                ->onDelete('cascade');

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
        Schema::dropIfExists('baskets');
    }
};
