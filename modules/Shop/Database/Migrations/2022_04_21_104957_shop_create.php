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
        Schema::create('shop', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('agent_id')->unsigned()->index();
            $table->bigInteger('city_id')->unsigned()->index();
            $table->bigInteger('company_id')->unsigned()->index();
            $table->string('name', 100);
            $table->string('address', 1000);
            $table->boolean('has_credit_line')->default(0);
            $table->json('location');
            $table->boolean('is_active')->default(0)->index();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->softDeletes();

            $table->foreign('agent_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('city_id')->references('id')->on('region_city')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('company_id')->references('id')->on('shop_company')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop');
    }
};
