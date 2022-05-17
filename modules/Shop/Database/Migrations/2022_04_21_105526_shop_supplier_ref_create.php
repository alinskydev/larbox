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
        Schema::create('shop_supplier_ref', function (Blueprint $table) {
            $table->bigInteger('shop_id')->unsigned();
            $table->bigInteger('supplier_id')->unsigned();

            $table->foreign('shop_id')->references('id')->on('shop')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('shop_supplier')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['shop_id', 'supplier_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_supplier_ref');
    }
};
