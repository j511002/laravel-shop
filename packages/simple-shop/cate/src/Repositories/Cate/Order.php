<?php
/**
 * Created by PhpStorm.
 * User: coffee
 * Date: 2017/8/17
 * Time: 上午12:59
 */

namespace SimpleShop\Cate\Repositories\Cate;


use SimpleShop\Repositories\Contracts\RepositoryInterface as Repository;
use SimpleShop\Repositories\Criteria\Criteria;

class Order extends Criteria
{
    /**
     * @var array
     */
    private $order;

    /**
     * Order constructor.
     *
     * @param array $order
     */
    public function __construct(array $order)
    {
        $this->order = $order;
    }

    /**
     * @param                     $model
     * @param Repository          $repository
     *
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        foreach ($this->order as $order => $by) {
            $model = $model->orderBy($order, $by);
        }

        return $model;
    }
}