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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal("price", 10,2, true);
            $table->decimal("discount", 10,2, true);
            $table->timestamps();

            $table->bigInteger('category_id')->unsigned();
            //$table->index('category_id', 'product_category_idx');
            $table->foreign('category_id', 'product_category_fk')->on('categories')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
