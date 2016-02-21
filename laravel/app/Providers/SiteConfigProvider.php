<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 下午8:26
 */

namespace AGarage\Providers;

use Log;
use Illuminate\Support\ServiceProvider;

class SiteConfigProvider extends ServiceProvider
{
    public function boot() {
        Log::error('Site Config provider is booting...');
        view()->share('site_name', env('SITE_NAME'));
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