<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/18
 * Time: 上午11:13
 */

namespace SimpleShop\Brand;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use SimpleShop\Brand\Contracts\Brand;
use SimpleShop\Brand\Repositories\BrandRepository;
use SimpleShop\Brand\Repositories\Order;
use SimpleShop\Brand\Repositories\Search;

class BrandImpl implements Brand
{
    private $repo;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->repo = $brandRepository;
    }

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
    ): LengthAwarePaginator {
        $this->repo->pushCriteria(new Search($search))
            ->pushCriteria(new Order($order))
            ->paginate($limit, $columns,
                $page);
    }

    /**
     * @param $id
     *
     * @return Model
     */
    public function show($id): Model
    {
        return $this->repo->find($id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->repo->delete($id);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    /**
     * @param       $id
     * @param array $data
     *
     * @return mixed
     */
    public function update($id, array $data)
    {
        return $this->repo->update($data, $id);
    }
}