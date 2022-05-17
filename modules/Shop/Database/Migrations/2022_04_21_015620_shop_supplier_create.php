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
        Schema::create('shop_supplier', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('creator_id')->unsigned()->index();
            $table->bigInteger('country_id')->unsigned()->index();
            $table->string('short_name', 100);
            $table->string('full_name', 100);
            $table->boolean('is_active')->default(0)->index();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->softDeletes();

            $table->foreign('creator_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('country_id')->references('id')->on('region_country')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_supplier');
    }
};
