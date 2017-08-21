<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/18
 * Time: 下午4:34
 */

namespace SimpleShop\CateBrand\Repositories;


use SimpleShop\CateBrand\Models\CommodityCateBrand;
use SimpleShop\Repositories\Eloquent\Repository;

class CateBrandRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return CommodityCateBrand::class;
    }
}