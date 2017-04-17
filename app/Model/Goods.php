<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    /**
     * 商品表
     *
     * @var string
     * @author zhulinjie
     */
    protected $table = 'data_goods';

    /**
     * 允许批量赋值的字段
     *
     * @var array
     * @author zhulinjie
     */
    protected $fillable = ['category_id', 'goods_label', 'goods_title', 'goods_original', 'goods_thumbnail', 'goods_info'];
}
