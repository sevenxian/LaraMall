<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetails extends Model
{
    /**
     *  软删除
     */
    use SoftDeletes;
    /**
     * 订单详情表
     *
     * @var string
     */
    protected $table = 'data_orders_details';

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['order_guid', 'user_id', 'goods_id', 'cargo_id', 'order_status','commodity_number','cargo_price','return_status','comment_status'];
}
