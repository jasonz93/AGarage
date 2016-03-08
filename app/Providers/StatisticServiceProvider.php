<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-3-8
 * Time: 下午1:29
 */

namespace AGarage\Providers;


use AGarage\Services\StatisticService;
use Illuminate\Support\ServiceProvider;

class StatisticServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('StatisticService', function () {
            return new StatisticService();
        });
    }
}