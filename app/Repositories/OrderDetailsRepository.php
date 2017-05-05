<?php

namespace App\Repositories;


use App\Model\OrderDetails;

class OrderDetailsRepository
{
    use BaseRepository;

    /**
     * @var OrderDetails
     */
    protected $model;

    public function __construct(OrderDetails $orderDetails)
    {
        $this->model = $orderDetails;
    }

    /**
     * 一次添加多条数据
     *
     * @param array $param
     * @return mixed
     * @author zhangyuchao
     */
    public function insertManyData(array $param)
    {
       return  $this->model->insert($param);
    }
}