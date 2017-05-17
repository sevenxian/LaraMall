<?php

namespace App\Presenters;

class HomeGoodsListPresenter
{
    /**
     * 删除选中的分类标签
     *
     * @param $key          选中的标签ID
     * @param $val          选中的标签值ID
     * @param $ev           选中的标签/标签值
     * @return string       返回要删除的分类标签对应的url
     * @author zhulinjie
     */
    public function delSelectedUrl($key, $val, $ev)
    {
        $url = '';
        if (count($ev) == 1) {
            $url = \Request::url();
        } else {
            unset($ev[$key]);
            $str = $this->convertUrl($ev);
            $url = \Request::url() . '?ev=' . $str;
        }
        return $url;
    }

    /**
     * 生成标签url
     *
     * @param $labelId      标签ID
     * @param $attrId       标签值ID
     * @param array $ev     已经选中的标签
     * @return string       返回标签对应的url
     * @author zhulinjie
     */
    public function createUrl($labelId, $attrId, $ev = [])
    {
        $url = '';
        if (empty($ev)) {
            $url = \Request::url() . '?ev=' . $labelId . '_' . $attrId;
        } else {
            $str = $this->convertUrl($ev);
            $url = \Request::url() . '?ev=' . $str . '%' . $labelId . '_' . $attrId;
        }
        return $url;
    }

    /**
     * 转换url格式
     *
     * @param array $ev
     * @return string
     * @author zhulinjie
     */
    public function convertUrl($ev = []){
        $str = '';
        foreach ($ev as $k => $v) {
            $str .= $k . '_' . $v . '%';
        }
        return rtrim($str, '%');
    }
}