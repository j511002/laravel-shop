<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/16
 * Time: 下午6:32
 */

namespace SimpleShop\Cate\Exceptions;


class ExceptionCode
{
    /*
     | 数据库错误
     */
    const CREATED_FAILURE = 10; // 创建数据失败
    const UPDATED_FAILURE = 11; // 修改数据失败
    const DELETED_FAILURE = 12; // 删除数据失败
    const DATA_EXIST = 13;      // 数据已经存在

    /*
     | 没有找到资源错误
     */
    const NOT_FIND_RESOURCE = 20; // 没有找到资源
}