<?php

namespace SimpleShop\CateBrand;

use Illuminate\Support\ServiceProvider;

class SimpleShopCateBrandServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(dirname(dirname(__FILE__)) . '/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
