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
        Schema::create('user_message', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('text', 4096)->nullable();
            $table->json('files_list')->default('[]');
            $table->boolean('is_sent_by_admin')->default(0);
            $table->boolean('is_seen')->default(0);
            $table->timestamp('created_at');

            $table->foreign('user_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_message');
    }
};
