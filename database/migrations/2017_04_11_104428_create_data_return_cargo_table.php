<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataReturnCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_return_cargo', function (Blueprint $table) {
            $table->increments('id')->comment('货品退货表');
            $table->integer('order_details_id')->index()->comment('货品退货表');
            $table->integer('user_id')->index()->comment('用户ID');
            $table->integer('goods_id')->index()->comment('商品ID');
            $table->integer('cargo_id')->index()->comment('货品ID');
            $table->integer('return_number')->comment('退货数量  不可以大于购买数量');
            $table->decimal('return_money',11,2)->comment('退款金额');
            $table->text('return_reason')->comment('退款原因');
            $table->json('return_image')->comment('退款货品展示图');
            $table->tinyInteger('return_status')->comment('退款状态 状态 1:待审核 2:取消申请退款 3:申请退款成功 4 : 审核失败| 默认为1');
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
        Schema::dropIfExists('data_return_cargo');
    }
}
