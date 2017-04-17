<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsLabel extends Model
{
    /**
     * @var string
     */
    protected $table = 'data_goods_labels';

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'goods_label_name'];
}
