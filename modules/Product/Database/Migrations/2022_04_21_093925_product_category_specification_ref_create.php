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
        Schema::create('product_category_specification_ref', function (Blueprint $table) {
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('specification_id')->unsigned();

            $table->foreign('category_id')->references('id')->on('product_category')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('specification_id')->references('id')->on('product_specification')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['category_id', 'specification_id'], 'pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_category_specification_ref');
    }
};
