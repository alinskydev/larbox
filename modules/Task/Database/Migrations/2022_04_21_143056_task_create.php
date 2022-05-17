<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Modules\Task\Enums\TaskEnums;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('agent_id')->unsigned()->index();
            $table->enum('type', array_keys(TaskEnums::types()));
            $table->string('name', 100);
            $table->string('description', 4096)->nullable();
            $table->string('execution_comment', 4096)->nullable();
            $table->date('deadline');
            $table->enum('agent_status', array_keys(TaskEnums::agentStatuses()))->default('opened');
            $table->enum('admin_status', array_keys(TaskEnums::adminStatuses()))->default('unchecked');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->softDeletes();

            $table->foreign('agent_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task');
    }
};
