<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataOtherBindTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_other_bind', function (Blueprint $table) {
            $table->increments('id')->comment('第三方信息绑定表');
            $table->integer('user_id')->unique()->comment('用户ID');
            $table->string('other_id',32)->unique()->comment('第三方账号ID1');
            $table->string('other_id_2',32)->unique()->nullable()->comment('第三方账号ID2');
            $table->tinyInteger('other_source')->comment('第三方来源 1 微信 2 微博 3 QQ ');
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
        Schema::dropIfExists('data_other_bind');
    }
}
