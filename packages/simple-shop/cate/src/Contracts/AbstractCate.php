<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/18
 * Time: 下午2:56
 */

namespace SimpleShop\Cate\Contracts;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use SimpleShop\Cate\Exceptions\CommodityCateException;
use SimpleShop\Cate\Exceptions\ExceptionCode;
use SimpleShop\Cate\Repositories\Cate\GetChildren;
use SimpleShop\Cate\Repositories\Cate\GetLeaves;
use SimpleShop\Cate\Repositories\Cate\GetParentAll;
use SimpleShop\Repositories\Eloquent\Repository;

abstract class AbstractCate implements Cate
{
    /**
     * @var Repository
     */
    protected $repo;

    public function __construct()
    {
        $this->repo = $this->setRepository();
    }

    abstract public function setRepository();

    /**
     * 获取叶子节点
     *
     * @return Collection
     */
    public function getLeaves(): Collection
    {
        return $this->repo->pushCriteria(new GetLeaves())
            ->all([
                'id',
                'pid',
                'root_id',
                'deep',
                'name'
            ]);
    }

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
    public function getChildren($id, bool $all = false): Collection
    {
        if (! $all) {
            return $this->repo->pushCriteria(new GetChildren($id))->all();
        } else {
            return $this->repo->pushCriteria(new GetParentAll($id))->all();
        }
    }

    /**
     * 获取父级
     *
     * @param    int|string $id
     *
     * @return Model
     */
    public function getParent($id): Model
    {
        $temp = $this->show($id);

        $result = $this->repo->find($temp->pid);

        if (is_null($result)) {
            throw new CommodityCateException('没有找到对应的商品分类', ExceptionCode::NOT_FIND_RESOURCE);
        }

        return $result;
    }

    /**
     * @param int|string $id
     *
     * @return Collection
     */
    public function getParentAll($id): Collection
    {
        $ids = $this->repo->find($id, ['path'])->toArray();

        return $this->repo->pushCriteria(new GetParentAll($ids))
            ->all();
    }

    /**
     * 重置仓库
     *
     * @return $this
     */
    public function resetRepository()
    {
        $this->repo->makeModel();

        return $this;
    }
}