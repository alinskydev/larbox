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
        Schema::create('report', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('creator_id')->unsigned()->index();
            $table->bigInteger('shop_id')->unsigned()->index();
            $table->bigInteger('task_report_id')->unsigned()->index()->nullable();
            $table->enum('type', array_keys(ReportEnums::types()));
            $table->string('number', 100)->unique();
            $table->enum('date_period_type', array_keys(ReportEnums::datePeriodTypes()));
            $table->date('date_period_from');
            $table->date('date_period_to');
            $table->json('images_list')->default('[]');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->softDeletes();

            $table->foreign('creator_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('shop_id')->references('id')->on('shop')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('task_report_id')->references('id')->on('report')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report');
    }
};
