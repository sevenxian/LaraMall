<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataGoodsAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_goods_attributes', function (Blueprint $table) {
            $table->increments('id')->comment('商品属性表');
            $table->integer('category_id')->index()->comment('分类ID');
            $table->integer('goods_label_id')->index()->comment('商品标签表ID');
            $table->string('goods_label_name',32)->comment('商品标签名称');
            $table->string('goods_attribute_name',32)->comment('商品属性名称');
            $table->tinyInteger('goods_attribute_sort')->comment('商品属性排序');
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
        Schema::dropIfExists('data_goods_attributes');
    }
}
