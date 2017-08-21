<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/18
 * Time: 下午4:43
 */

namespace SimpleShop\CateBrand;


use SimpleShop\Cate\CateImpl;
use SimpleShop\Cate\Models\CommodityCate;
use SimpleShop\CateBrand\Contracts\CateBrand;
use SimpleShop\CateBrand\Repositories\CateBrandRepository;
use SimpleShop\CateBrand\Repositories\Join;
use SimpleShop\CateBrand\Repositories\Search;

class CateBrandImpl implements CateBrand
{
    private $repo;

    public function __construct(CateBrandRepository $repository)
    {
        $this->repo = $repository;
    }

    /**
     * @param array $search
     * @param int   $limit
     * @param int   $page
     *
     * @return mixed
     */
    public function getList(array $search = [], int $limit = 20, int $page = 1)
    {
        //
        return $this->repo->pushCriteria(new Join())
            ->pushCriteria(new Search($search))
            ->paginate();
    }

    /**
     * @param int                    $cateId
     * @param array|\ArrayAccess|int $brandId
     *
     * @return void
     */
    public function add($cateId, $brandId)
    {
        $data = [];
        if ((is_object($brandId) && $brandId instanceof \ArrayAccess) || is_array($brandId)) {
            foreach ($brandId as $item) {
                $data[] = [
                    'brand_id' => $item,
                    'cate_id'  => $cateId,
                ];
            }
        } else {
            $data[] = [
                'brand_id' => $brandId,
                'cate_id'  => $cateId,
            ];
        }

        foreach ($data as $item) {
            $this->repo->create($item);
        }
    }

    /**
     * @param int      $cateId
     * @param int|null $brandId
     *
     * @return mixed
     */
    public function remove($cateId, $brandId = null)
    {
        if (is_null($brandId)) {
            // 说明是删除cateId对应的全部
            $this->repo->pushCriteria(new Search(['cateId' => $cateId]))->delete();

            return true;
        }

        $this->repo->pushCriteria(new Search(['cateId' => $cateId, 'brandId' => $brandId]))->delete();

        return true;
    }
}