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
        Schema::create('shop_brand_ref', function (Blueprint $table) {
            $table->bigInteger('shop_id')->unsigned();
            $table->bigInteger('brand_id')->unsigned();

            $table->foreign('shop_id')->references('id')->on('shop')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('product_brand')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['shop_id', 'brand_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_brand_ref');
    }
};
