<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/16
 * Time: 下午6:23
 */

namespace SimpleShop\Cate\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommodityCate extends Model
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
    protected $guarded = [
        'id',
        'root_id',
        'deep',
        'path',
    ];

    /**
     * 在数组中想要隐藏的属性。
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parentCate()
    {
        return $this->hasOne(static::class, 'id', 'pid');
    }
}