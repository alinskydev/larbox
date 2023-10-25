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
        Schema::create('box_category', function (Blueprint $table) {
            $table->id();
            $table->integer('lft');
            $table->integer('rgt');
            $table->integer('parent_id')->nullable();
            $table->jsonb('name');
            $table->string('slug')->index();
            $table->timestamp('created_at')->index();
            $table->timestamp('updated_at');
            $table->softDeletes();

            $table->index(['lft', 'rgt', 'parent_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('box_category');
    }
};
