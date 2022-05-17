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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('creator_id')->unsigned()->index();
            $table->bigInteger('category_id')->unsigned()->index();
            $table->bigInteger('brand_id')->unsigned()->index();
            $table->string('model_number', 100);
            $table->string('sku', 100)->unique();
            $table->date('date_eol');
            $table->json('images_list')->default('[]');
            $table->boolean('is_active')->default(0)->index();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->softDeletes();

            $table->foreign('creator_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('category_id')->references('id')->on('product_category')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('brand_id')->references('id')->on('product_brand')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
