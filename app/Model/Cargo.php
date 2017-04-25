<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    /**
     * 货品表
     *
     * @var string
     * @author zhulinjie
     */
    protected $table = 'data_cargo';
    
    /**
     * 允许批量赋值的字段
     * 
     * @var array
     * @author zhulinjie
     */
    protected $fillable = [
        'category_id', 'goods_id', 'cargo_ids', 'cargo_cover', 'inventory', 'cargo_price', 'cargo_discount', 'cargo_original', 'cargo_info'
    ];

    /**
     * 多对一关联 / 一个货品属于某一个商品 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author zhulinjie
     */
    public function goods()
    {
        return $this->belongsTo(Goods::class, 'goods_id');
    }
}
