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
        Schema::create('user_city_ref', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('region_city')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'city_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_city_ref');
    }
};
