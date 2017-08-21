<?php
/**
 * Created by PhpStorm.
 * User: coffee
 * Date: 2017/8/17
 * Time: 上午1:01
 */

namespace SimpleShop\Cate\Repositories\Cate;


use SimpleShop\Repositories\Contracts\RepositoryInterface as Repository;
use SimpleShop\Repositories\Criteria\Criteria;

class GetLeaves extends Criteria
{
    /**
     * @param                     $model
     * @param Repository          $repository
     *
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $model = $model->whereRaw("id NOT IN (SELECT `pid` FROM commodity_cate)");

        return $model;
    }
}