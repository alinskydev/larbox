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
        Schema::create('user_region_ref', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('region_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('region_id')->references('id')->on('region')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'region_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_region_ref');
    }
};
