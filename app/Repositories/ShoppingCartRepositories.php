<?php

namespace App\Repositories;


use App\Model\ShoppingCart;

class ShoppingCartRepositories
{
    /**
     * @var ShoppingCart
     */
    protected $shoppingCart;

    /**
     * 注入
     *
     * ShoppingCartRepositories constructor.
     * @param ShoppingCart $shoppingCart
     */
    public function __construct(ShoppingCart $shoppingCart)
    {
        $this->shoppingCart = $shoppingCart;
    }

    public function createCargoForCart($param)
    {
        return $this->shoppingCart->create($param);
    }
}