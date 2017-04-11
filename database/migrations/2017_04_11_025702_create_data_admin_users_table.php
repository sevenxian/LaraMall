<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname',64)->comment('管理员昵称');
            $table->string('tel',32)->unique()->comment('手机号码');
            $table->string('password',255)->comment('登录密码');
            $table->string('avatar',64)->comment('头像');
            $table->ipAddress('last_login_ip')->comment('最后一次登录IP');
            $table->timestamp('last_login_at')->comment('最后一次登录时间');
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
        Schema::dropIfExists('data_admin_users');
    }
}
