<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/18
 * Time: 下午4:11
 */

namespace SimpleShop\CateBrand\Contracts;


interface CateBrand
{
    /**
     * @param array $search
     * @param int   $limit
     * @param int   $page
     *
     * @return mixed
     */
    public function getList(array $search = [], int $limit = 20, int $page = 1);

    /**
     * @param int $cateId
     * @param array|\ArrayAccess|int $brandId
     *
     * @return void
     */
    public function add($cateId, $brandId);

    /**
     * @param int $cateId
     * @param int|null $brandId
     *
     * @return mixed
     */
    public function remove($cateId, $brandId = null);
}