<?php
/**
 * Created by PhpStorm.
 * User: coffee
 * Date: 2017/8/17
 * Time: 上午1:05
 */

namespace SimpleShop\Cate\Repositories;


use SimpleShop\Repositories\Contracts\RepositoryInterface as Repository;
use SimpleShop\Repositories\Criteria\Criteria;

class GetParentAll extends Criteria
{
    /**
     * @var array
     */
    private $ids;

    /**
     * GetParent constructor.
     *
     * @param array $ids
     */
    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    /**
     * @param                     $model
     * @param Repository          $repository
     *
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $model = $model->whereIn('id', $this->ids);

        return $model;
    }
}