<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataCommentFractionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_comment_fraction', function (Blueprint $table) {
            $table->increments('id')->comment('评论分数表');
            $table->integer('comment_id')->comment('商品评价表ID');
            $table->tinyInteger('conformity')->comment('商品符合度  满分5分');
            $table->tinyInteger('speed')->comment('送货速度  满分5分');
            $table->tinyInteger('attitude')->comment('服务态度  满分5分');
            $table->tinyInteger('satisfied')->comment('满意度 满分5分');
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
        Schema::dropIfExists('data_comment_fraction');
    }
}
