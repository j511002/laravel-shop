<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/18
 * Time: 下午4:35
 */

namespace SimpleShop\CateBrand\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use SimpleShop\Repositories\Contracts\RepositoryInterface as Repository;
use SimpleShop\Repositories\Criteria\Criteria;

class Join extends Criteria
{
    /**
     * @param  Model|Builder $model
     * @param Repository     $repository
     *
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $model = $model->join('commodity_cates', 'commodity_cates.id', '=', 'cate_id')
            ->join('commodity_brands', 'commodity_brands.id', '=', 'brand_id');

        return $model;
    }
}