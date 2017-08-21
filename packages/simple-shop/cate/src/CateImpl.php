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
use SimpleShop\Cate\Contracts\AbstractCate;
use SimpleShop\Cate\Exceptions\CommodityCateException;
use SimpleShop\Cate\Exceptions\ExceptionCode;
use SimpleShop\Cate\Repositories\Cate\CateRepository;
use SimpleShop\Cate\Repositories\Cate\Order;
use SimpleShop\Cate\Repositories\Cate\Search;
use App;

class CateImpl extends AbstractCate
{
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
    public function destroy($id) :bool
    {
        if (false === $bool = $this->repo->delete($id)) {
            throw new CommodityCateException('商品分类没有删除成功', ExceptionCode::DELETED_FAILURE);
        }

        return $bool;
    }

    /**
     * 设置repo
     *
     * @return mixed|CateRepository
     */
    public function setRepository()
    {
        return App::make(CateRepository::class);
    }
}