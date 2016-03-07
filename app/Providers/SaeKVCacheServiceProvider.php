<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 下午4:57
 */

namespace AGarage\Providers;

use AGarage\Extensions\SaeKVCacheStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class SaeKVCacheServiceProvider extends ServiceProvider
{
    public function boot() {
        Cache::extend('saekv', function ($app) {
            return Cache::repository(new SaeKVCacheStore());
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }
}