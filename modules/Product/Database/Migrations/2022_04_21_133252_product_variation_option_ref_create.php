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
        Schema::create('product_variation_option_ref', function (Blueprint $table) {
            $table->bigInteger('variation_id')->unsigned();
            $table->bigInteger('option_id')->unsigned();

            $table->foreign('variation_id')->references('id')->on('product_variation')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('product_specification_option')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['variation_id', 'option_id'], 'pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variation_option_ref');
    }
};
