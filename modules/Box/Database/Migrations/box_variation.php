<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Helpers\MigrationHelper;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_variation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('box_id')->index();
            $table->jsonb('name');
            $table->string('image')->nullable();
            $table->integer('sort_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('box_variation');
    }
};
