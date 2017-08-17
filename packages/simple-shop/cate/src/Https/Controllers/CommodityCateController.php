<?php

namespace SimpleShop\Cate\Https\Controllers;

use App\Http\Controllers\Controller;
use SimpleShop\Cate\Contracts\Cate;
use SimpleShop\Cate\Exceptions\CommodityCateException;
use SimpleShop\Cate\Exceptions\ExceptionCode;
use SimpleShop\Cate\Https\Requests\Api\ListRequest;
use SimpleShop\Cate\Https\Requests\Api\SubmitRequest;
use SimpleShop\Cate\Https\Traits\ReturnFormat;
use SimpleShop\Commodity\Models\ShopGoodsModel;

class CommodityCateController extends Controller
{
    use ReturnFormat;

    /**
     * @var
     */
    private $service;

    public function __construct(Cate $commodityCateService)
    {
        $this->service = $commodityCateService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ListRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ListRequest $request)
    {
        return $this->paginate($this->service->index($request->all(), $request->getParams()['limit'],
            ['path' => 'asc']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TODO 该方法未实现
        throw new \RuntimeException("该方法未实现");
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @param SubmitRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SubmitRequest $request)
    {
        $this->service->create($request->all());

        return $this->success();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->service->show($id);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // TODO 该方法未实现
        throw new \RuntimeException("该方法未实现");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SubmitRequest $request
     * @param  int           $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SubmitRequest $request, $id = null)
    {
        $id = is_null($id) ?? $request->input('id');
        $this->service->update($id, $request->except(['userType']));

        return $this->success();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, $version = null)
    {
        $result = ShopGoodsModel::where('cate_id', $id)->first(['id']);
        if (! is_null($result)) {
            throw new CommodityCateException("该分类已经被商品使用", ExceptionCode::DATA_USED);
        }

        $result = $this->service->getChildren($id);

        if ($result->isNotEmpty()) {
            throw new CommodityCateException("该分类已经被其他分类使用", ExceptionCode::DATA_USED);
        }
        $this->service = clone $this->service;
        $this->service->destroy($id);

        return $this->success();
    }
}
