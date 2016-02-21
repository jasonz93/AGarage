<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 下午6:02
 */

namespace AGarage\Providers;

use AGarage\Extensions\SaeKVStorageAdapter;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Storage;


class SaeKVStorageServiceProvider extends ServiceProvider
{
    public function boot() {
        sae_debug('Booting SAE KV Storage Provider...');
        Storage::extend('files', function ($app, $config) {
            return new Filesystem(new SaeKVStorageAdapter());
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