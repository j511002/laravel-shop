<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommodityBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("commodity_brands", function (Blueprint $table) {
            $table->increments("id");
            $table->string("name", 32)->comment("品牌名称");
            $table->smallInteger('sort', false, true)->default(0)->comment('排序');
            $table->string('description')->default('')->comment('品牌备注');
            $table->string('cover')->default('')->comment('品牌封面');

            $table->dateTime("created_at");
            $table->dateTime("updated_at");
            $table->softDeletes();

            $table->index(['name', 'sort']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("commodity_brands");
    }
}
