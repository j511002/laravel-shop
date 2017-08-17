<?php
/**
 * Created by PhpStorm.
 * User: coffee
 * Date: 2017/8/17
 * Time: 上午1:03
 */

namespace SimpleShop\Cate\Repositories;


use SimpleShop\Repositories\Contracts\RepositoryInterface as Repository;
use SimpleShop\Repositories\Criteria\Criteria;

class GetChildAll extends Criteria
{
    /**
     * @var int|string
     */
    private $id;

    /**
     * GetChildAll constructor.
     *
     * @param int|string $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @param                     $model
     * @param Repository          $repository
     *
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $model = $model->where('path', 'like', ",{$this->id},");

        return $model;
    }
}