<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataUsersRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_users_register', function (Blueprint $table) {
            $table->increments('id')->comment('用户注册原始表');
            $table->string('register_name',32)->unique()->comment('注册名');
            $table->string('password',255)->comment('密码');
            $table->string('third_party_id',32)->comment('第三方 ID');
            $table->ipAddress('register_ip')->comment('注册ip');
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
        Schema::dropIfExists('data_users_register');
    }
}
