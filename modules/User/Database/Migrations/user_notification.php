<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Modules\User\Enums\NotificationEnums;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notification', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('creator_id')->index();
            $table->bigInteger('owner_id')->index();
            $table->enum('type', array_keys(NotificationEnums::types()));
            $table->jsonb('params');
            $table->boolean('is_seen')->default(0);
            $table->timestamp('created_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_notification');
    }
};
