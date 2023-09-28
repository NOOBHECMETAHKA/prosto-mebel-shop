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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('City');
            $table->string('Street');
            $table->string('House');
            $table->string('Entrance');
            $table->string('Apartment');
            $table->timestamps();

            $table->boolean('is_deleted')->default(0);

            $table->bigInteger('user_addresses_id')->unsigned();
            $table->foreign('user_addresses_id', 'user_addresses_fk')
                ->on('users')->references('id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
