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
        Schema::table('block', function (Blueprint $table) {
            $table->foreign('page_id')->references('id')->on('block_page')->onUpdate('cascade')->onDelete('cascade');
        });
    }
};
