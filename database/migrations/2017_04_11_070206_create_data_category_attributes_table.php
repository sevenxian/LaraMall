<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataCategoryAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_category_attributes', function (Blueprint $table) {
            $table->increments('id')->comment('分类属性表');
            $table->integer('category_id')->index()->comment('分类ID');
            $table->integer('category_label_id')->index()->comment('分类标签表ID');
            $table->string('category_label_name',32)->comment('分类标签名称');
            $table->string('attribute_name',32)->comment('分类属性名称');
            $table->string('attribute_sort',32)->comment('分类属性排序');
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
        Schema::dropIfExists('data_category_attributes');
    }
}
