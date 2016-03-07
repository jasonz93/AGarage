<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 下午10:22
 */

namespace AGarage\Http\Middleware;

use Closure;
use Lavary\Menu\Builder;
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

        Menu::make('RightNavbar', function (Builder $menu) {
            $menu->add(trans('admin.admin'), [
                'route' => 'admin'
            ]);
        });

        return $next($request);
    }
}