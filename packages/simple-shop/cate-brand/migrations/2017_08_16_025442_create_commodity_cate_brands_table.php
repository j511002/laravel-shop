<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommodityCateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("commodity_cate_brands", function (Blueprint $table) {
            $table->increments("id");
            $table->integer('cate_id', false, true)->comment('分类ID');
            $table->integer('brand_id', false, true)->comment('品牌ID');

            $table->index(['cate_id', 'brand_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("commodity_cate_brands");
    }
}
