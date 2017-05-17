<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataCategoryLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_category_labels', function (Blueprint $table) {
            $table->increments('id')->comment('分类标签表');
            $table->string('category_label_name',32)->comment('分类标签名称');
            $table->tinyInteger('status')->default(1)->comment('是否进行搜索 0:不搜索 1:搜索。商品列表页筛选使用');
            $table->timestamps();
            $table->softDeletes()->comment('软删除');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_category_labels');
    }
}
