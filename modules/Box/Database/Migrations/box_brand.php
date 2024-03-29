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
        Schema::create('box_brand', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('creator_id')->index();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('file')->nullable();
            $table->jsonb('files_list')->default('[]');
            $table->boolean('show_on_the_home_page')->default(0);
            $table->boolean('is_active')->default(0);
            $table->timestamp('created_at')->index();
            $table->timestamp('updated_at');
            $table->softDeletes();

            MigrationHelper::likeIndex($table, 'name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('box_brand');
    }
};
