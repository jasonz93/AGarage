<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 下午10:22
 */

namespace AGarage\Http\Middleware;

use Closure;
use Menu;

class MainNavbarMenu
{
    public function handle($request, Closure $next) {

        Menu::make('MainNavbar', function ($menu) {
            $menu->add('Homepage', [
                'route' => 'homepage'
            ]);
            $menu->add('Blog', [
                'route' => 'blog'
            ]);
        });

        return $next($request);
    }
}