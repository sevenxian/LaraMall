<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataGoodsLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_goods_labels', function (Blueprint $table) {
            $table->increments('id')->comment('商品标签表');
            $table->integer('category_id')->index()->comment('分类表ID');
            $table->string('goods_label_name',32)->comment('商品标签名称');
            $table->tinyInteger('goods_label_status')->default(0)->comment('是否进行筛选 0:不进行 1:启用 默认为0');
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
        Schema::dropIfExists('data_goods_labels');
    }
}
