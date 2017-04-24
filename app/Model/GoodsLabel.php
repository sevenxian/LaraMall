<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsLabel extends Model
{
    /**
     * 商品标签表
     *
     * @var string
     * @author zhulinjie
     */
    protected $table = 'data_goods_labels';

    /**
     * 可以批量赋值的字段
     *
     * @var array
     * @author zhulinjie
     */
    protected $fillable = ['category_id', 'goods_label_name'];
}
