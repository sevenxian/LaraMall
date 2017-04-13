<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    /**
     * @var string
     */
    protected $table = 'data_goods';

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'goods_label', 'goods_title', 'goods_original', 'goods_thumbnail', 'goods_info'];
}
