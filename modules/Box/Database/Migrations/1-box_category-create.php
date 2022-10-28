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
        Schema::create('box_category', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->index();
            $table->integer('depth')->unsigned()->index();
            $table->integer('position')->unsigned()->index();
            $table->json('name');
            $table->string('slug')->index();
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
        Schema::dropIfExists('box_category');
    }
};
