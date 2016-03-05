<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-3-5
 * Time: 下午9:23
 */

namespace AGarage\Providers;


use Illuminate\Support\ServiceProvider;

class ParsedownProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ParsedownService', function () {
            return new \Parsedown();
        });
    }
}