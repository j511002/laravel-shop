<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/18
 * Time: 上午10:27
 */

namespace SimpleShop\Brand\Contracts;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface Brand
{
    /**
     * 获取品牌列表
     *
     * @param array $search
     * @param int   $limit
     * @param array $columns
     * @param array $order
     * @param int   $page
     *
     * @return LengthAwarePaginator
     */
    public function getList(
        array $search = [],
        int $limit = 20,
        array $columns = ["*"],
        array $order = ['id' => 'desc'],
        int $page = 1
    ) :LengthAwarePaginator;

    /**
     * @param $id
     *
     * @return Model
     */
    public function show($id) :Model;

    /**
     * @param $id
     *
     * @return mixed
     */
    public function destroy($id);

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param       $id
     * @param array $data
     *
     * @return mixed
     */
    public function update($id, array $data);
}