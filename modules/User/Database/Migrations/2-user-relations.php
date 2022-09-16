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
        Schema::table('user', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('user_role')->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::table('user_notification', function (Blueprint $table) {
            $table->foreign('creator_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('owner_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::table('user_profile', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('cascade');
        });
    }
};
