<?php

namespace SimpleShop\Cate;

use Illuminate\Support\ServiceProvider;
use SimpleShop\Cate\Contracts\Cate;

class SimpleShopCateServiceProvider extends ServiceProvider
{
    /**
     * 是否延迟加载
     *
     * @var bool
     */
    public $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(dirname(dirname(__FILE__)) .'/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Cate::class, CateImpl::class);
    }

    /**
     * 获取由提供者提供的服务.
     *
     * @return array
     */
    public function provides()
    {
        return [
            Cate::class,
        ];
    }
}
