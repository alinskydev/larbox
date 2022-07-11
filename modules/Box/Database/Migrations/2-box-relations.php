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
        Schema::table('box', function (Blueprint $table) {
            $table->foreign('brand_id')->references('id')->on('box_brand')->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::table('box_brand', function (Blueprint $table) {
            $table->foreign('creator_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::table('box_tag_ref', function (Blueprint $table) {
            $table->foreign('box_id')->references('id')->on('box')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('box_tag')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('box_variation', function (Blueprint $table) {
            $table->foreign('box_id')->references('id')->on('box')->onUpdate('cascade')->onDelete('cascade');
        });
    }
};
