<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataUsersLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_users_login', function (Blueprint $table) {
            $table->increments('id')->comment('前台用户登录表');
            $table->string('email', 32)->unique()->nullable()->comment('邮箱');
            $table->integer('tel')->unique()->nullable()->comment('电话号码');
            $table->string('password', 100)->comment('密码');
            $table->string('openid', 100)->unique()->nullable()->comment('微信openid');
            $table->softDeletes();
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
        Schema::dropIfExists('data_users_login');
    }
}
