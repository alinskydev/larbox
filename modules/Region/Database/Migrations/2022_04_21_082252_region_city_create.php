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
        Schema::create('region_city', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('region_id')->unsigned()->index();
            $table->json('name');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->foreign('region_id')->references('id')->on('region')->onUpdate('cascade')->onDelete('restrict');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('region_city');
    }
};
