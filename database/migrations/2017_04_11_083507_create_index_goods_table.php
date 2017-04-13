<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_goods', function (Blueprint $table) {
            $table->increments('id')->comment('商品索引表');
            $table->integer('goods_id')->comment('商品ID');
            $table->integer('cargo_id')->comment('货品ID');
            $table->text('body')->comment('中文分词后的内容');
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
        Schema::dropIfExists('index_goods');
    }
}
