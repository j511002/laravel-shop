<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/8/16
 * Time: 下午6:34
 */

namespace SimpleShop\Cate\Exceptions;


use Throwable;

class CommodityCateException extends \RuntimeException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}