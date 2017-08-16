<?php
/**
 * Created by PhpStorm.
 * User: coffee
 * Date: 2017/8/17
 * Time: 上午1:02
 */

namespace SimpleShop\Cate\Repositories;


use SimpleShop\Repositories\Contracts\RepositoryInterface as Repository;
use SimpleShop\Repositories\Criteria\Criteria;

class GetChildren extends Criteria
{
    /**
     * @var int|string
     */
    private $id;

    /**
     * GetChildren constructor.
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
        $model = $model->where("pid", $this->id);

        return $model;
    }
}