<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2016/3/7
 * Time: 23:56
 */

namespace AGarage\Providers;


use AGarage\Extensions\Utils;
use Illuminate\Support\ServiceProvider;

class UtilsProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Utils', function () {
            return new Utils();
        });
    }
}