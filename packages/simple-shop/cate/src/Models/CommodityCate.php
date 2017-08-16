<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/16
 * Time: 下午6:23
 */

namespace SimpleShop\Cate\Models;


use Illuminate\Database\Eloquent\Model;

class CommodityCate extends Model
{
    /**
     * 主键
     */
    protected $primaryKey = "id";

    protected $guarded = [
        'id',
    ];
}