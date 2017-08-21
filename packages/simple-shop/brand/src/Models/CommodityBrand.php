<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/18
 * Time: 上午11:14
 */

namespace SimpleShop\Brand\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommodityBrand extends Model
{
    use SoftDeletes;

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
        'sort',
        'name',
        'description',
        'cover'
    ];

    /**
     * 在数组中想要隐藏的属性。
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];
}