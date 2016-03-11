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
use Auth;
use Entrust;

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
            $menu->add('留言板', [
                'route' => 'guestbook'
            ]);
            $menu->add(trans('resume.resume'), [
                'route' => 'resume'
            ]);
        });

        Menu::make('RightNavbar', function (Builder $menu) {

            if (Entrust::hasRole('admin')) {
                $menu->add(trans('admin.admin'), [
                    'route' => 'admin'
                ]);
            }
            if (Auth::check()) {
                $menu->add(Auth::user()->nickname, [
                    'id' => 'user',
                    'class' => 'dropdown'
                ]);
                $menu->add(trans('auth.logout'), [
                    'parent' => 'user',
                    'route' => 'auth.logout',
                ]);
            } else {
                $menu->add(trans('auth.login'), [
                    'route' => 'auth.login'
                ]);
            }
        });

        return $next($request);
    }
}