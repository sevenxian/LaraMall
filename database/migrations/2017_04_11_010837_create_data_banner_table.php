<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_banner', function (Blueprint $table) {
            $table->increments('id')->comment('轮播图表');
            $table->string('name',32)->comment('轮播图名称');
            $table->string('big_banner',64)->comment('大轮播图PC使用');
            $table->string('small_banner',64)->comment('小轮播图手机使用');
            $table->string('banner_url',64)->comment('轮播图跳转地址');
            $table->tinyInteger('status')->comment('轮播图状态 1:启用 2:禁用');
            $table->softDeletes()->comment('软删除');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_banner');
    }
}
