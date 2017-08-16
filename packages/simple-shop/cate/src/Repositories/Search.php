<?php
/**
 * Created by PhpStorm.
 * User: coffee
 * Date: 2017/8/17
 * Time: 上午12:58
 */

namespace SimpleShop\Cate\Repositories;


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
        if (isset($this->search['name'])) {
            $model = $model->where('name', 'like', "%{$this->search['name']}%");
        }

        return $model;
    }
}