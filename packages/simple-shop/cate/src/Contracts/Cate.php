<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/16
 * Time: 下午5:26
 */

namespace SimpleShop\Cate\Contracts;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface Cate
{
    /**
     * 获取叶子节点
     *
     * @return Collection
     */
    public function getLeaves(): Collection;

    /**
     * 获取子代节点
     *
     * @param      $id
     * @param bool $all 是否获取全部子级
     *              true: 是
     *              false: 取得自己下一层的子代
     *
     * @return Collection
     */
    public function getChildren($id, bool $all = false): Collection;

    /**
     * 获取父级
     *
     * @param    int|string $id
     *
     * @return Model
     */
    public function getParent($id): Model;

    /**
     * @param int|string $id
     *
     * @return Collection
     */
    public function getParentAll($id): Collection;

    /**
     * @param array $search
     * @param int   $limit
     * @param array $order
     * @param int   $page
     * @param array $columns
     *
     * @return LengthAwarePaginator
     */
    public function index(
        array $search = [],
        int $limit = 20,
        array $order = ['id' => 'desc'],
        array $columns = ['*'],
        int $page = 1
    ): LengthAwarePaginator;

    /**
     * @param int|string $id
     *
     * @return Model|\stdClass
     */
    public function show($id): Model;

    /**
     * @param array $data
     *
     * @return Model|\stdClass
     */
    public function create(array $data): Model;

    /**
     * @param  int|string $id
     * @param array       $data
     *
     * @return bool
     */
    public function update($id, array $data): bool;

    /**
     * @param int|string $id
     *
     * @return mixed
     */
    public function destroy($id) :bool;

    /**
     * 重置仓库
     *
     * @return $this
     */
    public function resetRepository();
}