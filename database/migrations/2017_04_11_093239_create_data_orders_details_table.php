<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataOrdersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_orders_details', function (Blueprint $table) {
            $table->increments('id')->comment('商品订单详情表');
            $table->char('order_guid',32)->index()->comment('商品订单编号');
            $table->integer('user_id')->index()->comment('用户ID');
            $table->integer('goods_id')->index()->comment('商品ID');
            $table->integer('cargo_id')->index()->comment('货品ID');
            $table->tinyInteger('order_status')->comment('1:待付款 2: 待发货 3:待收货 4:待评价 5:完成');
            $table->tinyInteger('commodity_number')->default(1)->comment('货品数量');
            $table->decimal('cargo_price',11,2)->comment('货品价格');
            $table->tinyInteger('return_status')->comment('退货状态: 1 不退货 2:退货');
            $table->tinyInteger('comment_status')->comment('评论状态: 1 未评论 2:已评论');
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
        Schema::dropIfExists('data_orders_details');
    }
}
