<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataGoodsCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_goods_comment', function (Blueprint $table) {
            $table->increments('id')->comment('商品评论表');
            $table->integer('goods_id')->index()->comment('商品ID');
            $table->integer('user_id')->index()->comment('用户ID');
            $table->integer('cargo_id')->comment('货品ID');
            $table->tinyInteger('comment_type')->default(0)->comment('评价人状态 0:匿名评价 1:显示用户名');
            $table->text('comment_info')->nullable()->comment('评价内容');
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
        Schema::dropIfExists('data_goods_comment');
    }
}
