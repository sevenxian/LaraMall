<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_cargo', function (Blueprint $table) {
            $table->increments('id')->comment('货品表');
            $table->integer('category_id')->index()->comment('分类ID');
            $table->integer('goods_id')->index()->comment('商品ID');
            $table->string('cargo_cover',64)->comment('货品封标');
            $table->integer('inventory')->default(0)->comment('货品数量');
            $table->decimal('cargo_price',7,2)->comment('货品原价');
            $table->float('cargo_discount')->default(1)->comment('货品折扣');
            $table->json('cargo_original')->comment('货品原图:多个');
            $table->json('cargo_thumbnail')->comment('货品缩略图:多个');
            $table->text('cargo_info')->comment('货品详情');
            $table->tinyInteger('cargo_status')->default(1)->comment('货品状态 1:待售 2:上架 3:下架	默认为 1');
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
        Schema::dropIfExists('data_cargo');
    }
}
