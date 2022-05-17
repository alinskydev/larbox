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
        Schema::create('product_specification_option', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('specification_id')->unsigned()->index();
            $table->json('name');
            $table->smallInteger('sort_index')->unsigned()->index();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->foreign('specification_id')->references('id')->on('product_specification')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_specification_option');
    }
};
