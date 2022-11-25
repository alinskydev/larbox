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
        Schema::create('box', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('brand_id')->unsigned()->index();
            $table->jsonb('name');
            $table->string('slug')->unique();
            $table->jsonb('description')->default('[]');
            $table->bigInteger('price')->unsigned();
            $table->date('date');
            $table->dateTime('datetime');
            $table->string('image')->nullable();
            $table->jsonb('images_list')->default('[]');
            $table->timestamp('created_at')->index();
            $table->timestamp('updated_at');
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
        Schema::dropIfExists('box');
    }
};