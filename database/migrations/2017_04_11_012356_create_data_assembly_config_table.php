<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataAssemblyConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_assembly_config', function (Blueprint $table) {
            $table->increments('id')->comment('网站组件配置表');
            $table->string('name',32)->unique()->comment('组件名称');
            $table->tinyInteger('type')->comment('组件类型:1.支付组件 2.云存储 3短信发送');
            $table->string('key_id',64)->unique()->comment('组件的key');
            $table->string('key_secret',64)->comment('组件的secret');
            $table->json('other_message')->nullable()->comment('组件其他信息');
            $table->tinyInteger('status')->default(2)->comment('组件状态 1启用 2 禁用');
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
        Schema::dropIfExists('data_assembly_config');
    }
}
