<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Model
 */
class Category extends Model
{
    use SoftDeletes;

    /**
     * 分类表
     *
     * @var string
     */
    protected $table = 'data_category';

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['pid', 'name', 'level', 'describe', 'img'];

    /**
     * ORM 对应关系 / 获取父类信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author: Luoyan
     */
    public function parentCategory()
    {
        return $this->belongsTo(static::class, 'pid', 'id');
    }
}
