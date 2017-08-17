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
use SimpleShop\Cate\Repositories\GetChildAll;
use SimpleShop\Cate\Repositories\GetChildren;
use SimpleShop\Cate\Repositories\GetLeaves;
use SimpleShop\Cate\Repositories\GetParentAll;
use SimpleShop\Cate\Repositories\Order;
use SimpleShop\Cate\Repositories\Search;
use App;

class CateImpl implements Cate
{
    private $repo;

    public function __construct(CateRepository $cateRepository)
    {
        $this->repo = $cateRepository;
    }

    public function __clone()
    {
        $this->repo = App::make(CateRepository::class);
    }

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
            return $this->repo->pushCriteria(new GetChildAll($id))->all();
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
    ): LengthAwarePaginator {
        return $this->repo->pushCriteria(new Search($search))
            ->pushCriteria(new Order($order))
            ->paginate($limit, $columns, $page);
    }

    /**
     * @param int|string $id
     *
     * @return Model|\stdClass
     */
    public function show($id): Model
    {
        $result = $this->repo->with(['parentCate'])->find($id);

        if (is_null($result)) {
            throw new CommodityCateException("没有找到对应的商品分类", ExceptionCode::NOT_FIND_RESOURCE);
        }

        return $result;
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
            $deep = (int)$parent->deep + 1;
            // 计算path
            $path = $parent->path . $result->id . ",";
        } else {
            // 计算根id
            $rootId = $result->id;
            // 计算深度
            $deep = 0;
            // 计算path
            $path = "," . $result->id . ",";
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
        if (false === $bool = $this->repo->delete($id)) {
            throw new CommodityCateException('商品分类没有删除成功', ExceptionCode::DELETED_FAILURE);
        }

        return $bool;
    }
}