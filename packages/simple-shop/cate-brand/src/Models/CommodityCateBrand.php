<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/18
 * Time: 下午4:02
 */

namespace SimpleShop\CateBrand\Models;


use Illuminate\Database\Eloquent\Model;
use SimpleShop\Brand\Models\CommodityBrand;
use SimpleShop\Cate\Models\CommodityCate;

class CommodityCateBrand extends Model
{
    /**
     * 主键
     */
    protected $primaryKey = "id";

    /**
     * 黑名单列表
     *
     * @var array
     */
    protected $fillable = [
        'cate_id',
        'brand_id'
    ];

    /**
     * 在数组中想要隐藏的属性。
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cate()
    {
        return $this->belongsTo(CommodityCate::class, 'cate_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(CommodityBrand::class, 'brand_id', 'id');
    }
}