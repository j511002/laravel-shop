<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/16
 * Time: 下午5:23
 */

namespace SimpleShop\Cate;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use SimpleShop\Cate\Contracts\Cate;
use SimpleShop\Cate\Exceptions\CommodityCateException;
use SimpleShop\Cate\Exceptions\ExceptionCode;
use SimpleShop\Cate\Repositories\CateRepository;

class CateImpl implements Cate
{
    private $repo;

    public function __construct(CateRepository $cateRepository)
    {
        $this->repo = $cateRepository;
    }

    /**
     * 获取叶子节点
     *
     * @return Collection
     */
    public function getLeaves(): Collection
    {
        // TODO: Implement getLeaves() method.
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
        // TODO: Implement getChildren() method.
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
        // TODO: Implement getParent() method.
    }

    /**
     * @param int|string $id
     *
     * @return Collection
     */
    public function getParentAll($id): Collection
    {
        // TODO: Implement getParentAll() method.
    }

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
        int $page = 1,
        array $columns = ['*']
    ): LengthAwarePaginator {
        // TODO: Implement index() method.
    }

    /**
     * @param int|string $id
     *
     * @return Model|\stdClass
     */
    public function show($id): Model
    {
        // TODO: Implement show() method.
    }

    /**
     * @param array $data
     *
     * @return Model|\stdClass
     */
    public function create(array $data): Model
    {
        $result = $this->repo->create($data);
        $pid = empty($data['pid']) ? 0 : $data['pid'];


        if ((int)$pid !== 0) {
            // 计算根id
            $parent = $this->show($data['pid']);
            $rootId = $parent->root_id;
            // 计算深度
            $deep = $parent->deep + 1;
            // 计算path
            $path = $parent->path . "," . $result->id;
        } else {
            // 计算根id
            $rootId = $result->id;
            // 计算深度
            $deep = 1;
            // 计算path
            $path = $result->id;
        }

        /*
         | 将根id和分类深度写回去
         | 使用save方法
         */
        $result->root_id = $rootId;
        $result->deep = $deep;
        $result->path = $path;
        if (! $result->save()) {
            throw new CommodityCateException("商品分类没有添加成功", ExceptionCode::CREATED_FAILURE);
        }

        return $result;
    }

    /**
     * @param  int|string $id
     * @param array       $data
     *
     * @return bool
     */
    public function update($id, array $data): bool
    {
        $bool = $this->repo->update($data, $id);
        if (false === $bool) {
            throw new CommodityCateException('商品分类没有修改成功', ExceptionCode::UPDATED_FAILURE);
        }

        return $bool;
    }

    /**
     * @param int|string $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        if (false === $bool = $this->repo->applyCriteria()->delete($id)) {
            throw new CommodityCateException('商品分类没有删除成功', ExceptionCode::DELETED_FAILURE);
        }

        return $bool;
    }
}