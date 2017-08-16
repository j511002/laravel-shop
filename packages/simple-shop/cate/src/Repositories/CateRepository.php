<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/16
 * Time: 下午5:42
 */

namespace SimpleShop\Cate\Repositories;


use SimpleShop\Cate\Models\CommodityCate;
use SimpleShop\Repositories\Eloquent\Repository;

class CateRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return CommodityCate::class;
    }
}