<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataRecommendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_recommend', function (Blueprint $table) {
            $table->increments('id')->comment('推荐位表');
            $table->string('recommend_name')->comment('推荐位名称');
            $table->string('recommend_type')->comment('推荐位置:1首页，2列表页');
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
        Schema::dropIfExists('data_recommend');
    }
}