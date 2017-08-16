<?php
/**
 * Created by PhpStorm.
 * User: coffee
 * Date: 2017/8/17
 * Time: 上午1:10
 */

namespace SimpleShop\Cate;


use Illuminate\Support\Facades\Facade;
use SimpleShop\Cate\Contracts\Cate;

class CommodityCateFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Cate::class;
    }
}