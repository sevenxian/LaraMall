<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsCollection extends Model
{
    /**
     * 收货地址表
     *
     * @var string
     */
    protected $table = 'data_goods_collection';

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'cargo_id'];

}
