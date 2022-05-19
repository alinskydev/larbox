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
        Schema::table('region_city', function (Blueprint $table) {
            $table->foreign('region_id')->references('id')->on('region')->onUpdate('cascade')->onDelete('restrict');
        });
    }
};
