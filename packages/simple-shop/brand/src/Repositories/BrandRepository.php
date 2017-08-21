<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/18
 * Time: 上午11:18
 */

namespace SimpleShop\Brand\Repositories;


use SimpleShop\Brand\Models\CommodityBrand;
use SimpleShop\Repositories\Eloquent\Repository;

class BrandRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return CommodityBrand::class;
    }
}