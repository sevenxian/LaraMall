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
        'category_id',
        'goods_id',
        'cargo_ids',
        'cargo_cover',
        'inventory',
        'cargo_price',
        'cargo_discount',
        'cargo_original',
        'cargo_info'
    ];

    /**
     * 多对多关联关系 / 一个货品对应多个推荐位
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author zhulinjie
     */
    public function recommends()
    {
        return $this->belongsToMany(Recommend::class, 'rel_recommend_goods', 'recommend_id', 'cargo_id')->withTimestamps();
    }
}
