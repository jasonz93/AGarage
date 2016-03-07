<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2016/3/7
 * Time: 23:44
 */

namespace AGarage\Http\Middleware;


use Closure;
use Lavary\Menu\Builder;
use Menu;

class AdminSidebarMenu
{
    public function handle($request, Closure $next) {

        Menu::make('AdminSidebar', function (Builder $menu) {
            $menu->add(trans('admin.statistics.statistics'), [
                'route' => 'admin.statistics'
            ])->link->attr('class', 'list-group-item');
        });

        return $next($request);
    }
}