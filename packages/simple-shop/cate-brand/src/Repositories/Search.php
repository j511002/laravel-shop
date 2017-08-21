<?php
/**
 * Created by PhpStorm.
 * User: coffee
 * Date: 2017/8/17
 * Time: 上午12:58
 */

namespace SimpleShop\CateBrand\Repositories;


use SimpleShop\Repositories\Contracts\RepositoryInterface as Repository;
use SimpleShop\Repositories\Criteria\Criteria;

class Search extends Criteria
{
    /**
     * @var array
     */
    private $search;

    /**
     * Search constructor.
     *
     * @param array $search
     */
    public function __construct(array $search)
    {
        $this->search = $search;
    }

    /**
     * @param            $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        if (isset($this->search['cateName'])) {
            $model = $model->where('commodity_cates.name', 'like', "%{$this->search['cateName']}%");
        }

        if (isset($this->search['brandName'])) {
            $model = $model->where('commodity_brands.name', 'like', "%{$this->search['brandName']}%");
        }

        if (isset($this->search['cateId'])) {
            $model = $model->where('cate_id', '=', "cateId");
        }

        if (isset($this->search['brandId'])) {
            $model = $model->where('brand_id', '=', "brandId");
        }

        return $model;
    }
}