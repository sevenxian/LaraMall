<?php

namespace App\Presenters;

class HomeGoodsListPresenter
{
    /**
     * 清除标签筛选
     *
     * @param $category_id
     * @param string $sort
     * @return string
     * @author zhulinjie
     */
    public function destroy($category_id, $sort = '')
    {
        if (!$sort) {
            return '/home/goodsList/' . $category_id;
        } else {
            return '/home/goodsList/' . $category_id . '?sort=' . $sort;
        }
    }

    /**
     * 删除选中的分类标签
     *
     * @param $key                  选中的标签ID
     * @param $val                  选中的标签值ID
     * @param $ev                   选中的标签/标签值
     * @param string $sort 排序标识
     * @return string               返回要删除的分类标签对应的url
     * @author zhulinjie
     */
    public function delSelectedUrl($key, $val, $ev, $sort = '')
    {
        $url = '';
        if (count($ev) == 1) {
            if (!$sort) {
                $url = \Request::url();
            } else {
                $url = \Request::url() . '?' . '&sort=' . $sort;
            }
        } else {
            unset($ev[$key]);
            $str = $this->convertUrl($ev);
            if (!$sort) {
                $url = \Request::url() . '?ev=' . $str;
            } else {
                $url = \Request::url() . '?ev=' . $str . '&sort=' . $sort;
            }
        }
        return $url;
    }

    /**
     * 生成标签url
     *
     * @param $labelId          标签ID
     * @param $attrId           标签值ID
     * @param array $ev 已经选中的标签
     * @param string $sort 排序标识
     * @return string           返回标签对应的url
     * @author zhulinjie
     */
    public function createUrl($labelId, $attrId, $ev = [], $sort = '')
    {
        $url = '';
        if (empty($ev)) {
            if (!$sort) {
                $url = \Request::url() . '?ev=' . $labelId . '_' . $attrId;
            } else {
                $url = \Request::url() . '?ev=' . $labelId . '_' . $attrId . '&sort=' . $sort;
            }
        } else {
            $str = $this->convertUrl($ev);
            if (!$sort) {
                $url = \Request::url() . '?ev=' . $str . '%' . $labelId . '_' . $attrId;
            } else {
                $url = \Request::url() . '?ev=' . $str . '%' . $labelId . '_' . $attrId . '&sort=' . $sort;
            }
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
    public function convertUrl($ev = [])
    {
        $str = '';
        foreach ($ev as $k => $v) {
            $str .= $k . '_' . $v . '%';
        }
        return rtrim($str, '%');
    }

    /**
     * 生成url
     *
     * @param string $param
     * @return string
     * @author zhulinjie
     */
    public function createSortUrl($param = '')
    {
        if (!$_SERVER["QUERY_STRING"]) {
            $queryString = '';
        } else {
            $queryArr = explode('&', $_SERVER["QUERY_STRING"]);
            foreach ($queryArr as $key => $v) {
                if (strpos($v, 'sort') !== false) {
                    unset($queryArr[$key]);
                }
            }
            if (!empty($queryArr)) {
                $queryString = implode('&', $queryArr);
            } else {
                $queryString = '';
            }
        }

        switch ($param) {
            case 'sort':
                return $queryString ? \Request::url() . '?' . $queryString . '&sort=sort_asc' : \Request::url() . '?sort=sort_asc';
                break;
            case 'comment':
                return $queryString ? \Request::url() . '?' . $queryString . '&sort=comment_asc' : \Request::url() . '?sort=comment_asc';
                break;
            default:
                return $queryString ? \Request::url() . '?' . $queryString : \Request::url();
        }
    }
}