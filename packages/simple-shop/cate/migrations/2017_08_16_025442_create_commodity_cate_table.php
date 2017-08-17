<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommodityCateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("commodity_cates", function (Blueprint $table) {
            $table->increments("id");
            $table->integer('pid', false, true)->default(0)->comment('父id');
            $table->integer('root_id', false, true)->default(0)->comment('根id');
            $table->tinyInteger('deep', false, true)->default(1)->comment('分类的深度');
            $table->string("path", 32)->default(0)->comment("分类树");
            $table->smallInteger('sort', false, true)->default(0)->comment('排序');
            $table->string("name", 32)->comment("分类名称");
            $table->string('title', 32)->default('')->comment('分类标题');
            $table->string('keyword')->default('')->comment('分类关键字');
            $table->string('cate_dir', 32)->default('')->comment('分类dir');

            $table->dateTime("created_at");
            $table->dateTime("updated_at");
            $table->softDeletes();

            $table->index("pid");
            $table->index("root_id");
            $table->index("deep");
            $table->index("path");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("commodity_cates");
    }
}
