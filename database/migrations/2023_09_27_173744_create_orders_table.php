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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_cost', 10, 2, true);
            $table->timestamps();

            $table->bigInteger('status_order_id')->unsigned();
            $table->foreign('status_order_id', 'status_order_fk')
                ->on('statuses')->references('id')
                ->onDelete('cascade');

            $table->bigInteger('address_order_id')->unsigned();
            $table->foreign('address_order_id', 'address_order_fk')
                ->on('addresses')->references('id')
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
        Schema::dropIfExists('orders');
    }
};
