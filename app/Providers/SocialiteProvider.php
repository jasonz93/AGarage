<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2016/3/10
 * Time: 0:53
 */

namespace AGarage\Providers;


use AGarage\Socialite\WeiboProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Socialite;

class SocialiteProvider extends ServiceProvider
{
    public function boot() {
        Socialite::extend('weibo', function (Application $app) {
            $config = $app['config']['services.weibo'];

            return new WeiboProvider($app['request'], $config['client_id'], $config['client_secret'], $config['redirect']);
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