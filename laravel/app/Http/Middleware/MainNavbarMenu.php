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
            $menu->add(trans('homepage.homepage'), [
                'route' => 'homepage'
            ]);
            $menu->add(trans('blog.blog'), [
                'route' => 'blog'
            ]);
            $menu->add(trans('resume.resume'), [
                'route' => 'resume'
            ]);
        });

        return $next($request);
    }
}