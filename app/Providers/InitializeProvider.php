<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2016/3/9
 * Time: 0:43
 */

namespace AGarage\Providers;


use AGarage\Console\Commands\InitCommand;
use Illuminate\Support\ServiceProvider;

class InitializeProvider extends ServiceProvider
{

    public function boot() {
        $this->commands('command.init');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommand();
    }

    public function registerCommand() {
        $this->app->singleton('command.init', function () {
            return new InitCommand();
        });
    }
}