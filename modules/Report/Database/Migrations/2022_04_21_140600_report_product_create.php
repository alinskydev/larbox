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
        Schema::create('report_product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('report_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->bigInteger('variation_id')->unsigned()->index()->nullable();
            $table->bigInteger('supplier_id')->unsigned()->index();
            $table->integer('quantity');
            $table->smallInteger('sort_index')->unsigned()->index();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->foreign('report_id')->references('id')->on('report')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('product')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('variation_id')->references('id')->on('product_variation')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('supplier_id')->references('id')->on('shop_supplier')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_product');
    }
};
