<?php

namespace App\Repositories;


use App\Model\Address;

class AddressRepository
{
    /**
     * @var Address
     */
    protected $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    /**
     * 添加一条收货地址
     *
     * @param array $param
     * @return static
     * @author zhangyuchao
     */
    public function createOneAddress(array $param)
    {
        return $this->address->create($param);
    }

    /**
     * 获取收货地址列表
     *
     * @param array $where
     * @return mixed
     * @author zhangyuchao
     */
    public function getAddressAllData(array $where)
    {
        return $this->address->where($where)->get();
    }

    /**
     * 计算单个用户收货地址个数
     *
     * @param array $where
     * @author zhangyuchao
     */
    public function getUserAddressCount(array $where)
    {
        return $this->address->where($where)->count();
    }

    /**
     * 删除单条数据
     *
     * @param $id
     * @return mixed
     * @author zhangyuchao
     */
    public function deleteOneData($id)
    {
        return $this->address->destroy($id);
    }

    /**
     * 修改单条地址数据
     *
     * @param array $where
     * @param array $param
     * @return mixed
     * @author zhangyuchao
     */
    public function updateOneAddress(array $where,array $param)
    {
        return $this->address->where($where)->update($param);
    }

    /**
     * 根据条件获取单挑数据
     *
     * @param array $where
     * @return mixed
     * @author zhangyuchao
     */
    public function getOneAddressData(array $where)
    {
        return $this->address->where($where)->first();
    }
}