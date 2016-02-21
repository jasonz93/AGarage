<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 下午8:05
 */

namespace AGarage\Extensions;


use Illuminate\Foundation\Application;

class SaeApplication extends Application
{
    /**
     * Get the path to the cached "compiled.php" file.
     *
     * @return string
     */
    public function getCachedCompilePath()
    {
        return 'saekv:///laravel/bootstrap/cache/compiled.php';
    }

    /**
     * Get the path to the cached services.php file.
     *
     * @return string
     */
    public function getCachedServicesPath()
    {
        return 'saekv:///laravel/bootstrap/cache/services.php';
    }
}