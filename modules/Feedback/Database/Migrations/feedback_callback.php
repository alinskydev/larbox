<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Helpers\MigrationHelper;

use Modules\Feedback\Enums\FeedbackStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_callback', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone');
            $table->string('message')->nullable();
            $table->enum('status', FeedbackStatusEnum::values())->default(FeedbackStatusEnum::UNPROCESSED->value);
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
        Schema::dropIfExists('feedback_callback');
    }
};
