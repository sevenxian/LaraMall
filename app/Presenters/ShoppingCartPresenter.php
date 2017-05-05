<?php

namespace App\Presenters;


class ShoppingCartPresenter
{
    /**
     * 计算货品总数量
     *
     * @param $data
     * @return int
     * @author zhangyuchao
     */
    public function numberForCargo($data)
    {
        // 初始化货品数量
        $number = 0;
        // 计算货品数量
        foreach ($data as $item) {
            $number += $item['shopping_number'];
        }
        // 返回
        return $number;
    }

    /**
     * 计算总价格
     *
     * @param $data
     * @return int
     * @author zhangyuchao
     */
    public function totalPrice($data)
    {
        // 初始化总价格
        $price = 0;
        // 计算总价格
        foreach ($data as $item) {
            $price += $item['shopping_number'] * $item['cargo_discount'];
        }
        // 返回
        return $price;
    }
}