<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataGoodsRunWaterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_goods_run_water', function (Blueprint $table) {
            $table->increments('id')->comment('商品进出帐流水表');
            $table->integer('order_details_id')->index()->nullable()->comment('订单详情表ID');
            $table->integer('return_id')->index()->nullable()->comment('退货表ID');
            $table->tinyInteger('type')->comment('出入账状态 1:代表进账 2:代表出账');
            $table->string('remarks',255)->comment('备注');
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
        Schema::dropIfExists('data_goods_run_water');
    }
}
