<?php
/**
 * Created by PhpStorm.
 * User: zhulinjie
 * Date: 2017/4/21
 * Time: 9:46
 */

namespace App\Repositories;

use App\Model\GoodsAttribute;

/**
 * Class GoodsAttributeRepository
 * @package App\Repositories
 */
class GoodsAttributeRepository
{
    /**
     * 商品标签值操作类
     *
     * @var
     * @author zhulinjie
     */
    protected $GoodsAttrbute;

    public function __construct(GoodsAttribute $goodsAttribute)
    {
        // 注入商品标签值操作类
        $this->goodsAttrbute = $goodsAttribute;
    }

    /**
     * 添加商品标签值
     *
     * @param $data
     * @return static
     * @author zhulinjie
     */
    public function addGoodsAttribute($data)
    {
        return $this->goodsAttrbute->create($data);
    }

    /**
     * 根据ID获取标签值名称
     *
     * @param $where
     * @return mixed
     * @author zhangyuchao
     */
    public function getOneGoodsAttr($where)
    {
        return $this->goodsAttrbute->where($where)->first();
    }
}