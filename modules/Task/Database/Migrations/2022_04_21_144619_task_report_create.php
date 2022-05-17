<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Modules\Report\Enums\ReportEnums;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_report', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('task_id')->unsigned()->index();
            $table->bigInteger('shop_id')->unsigned()->index();
            $table->enum('type', array_keys(ReportEnums::types()));
            $table->enum('date_period_type', array_keys(ReportEnums::datePeriodTypes()));
            $table->smallInteger('sort_index')->unsigned()->index();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->foreign('task_id')->references('id')->on('task')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('shop')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_report');
    }
};
