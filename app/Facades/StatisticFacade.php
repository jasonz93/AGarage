<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-3-8
 * Time: 下午1:30
 */

namespace AGarage\Facades;


use Illuminate\Support\Facades\Facade;

class StatisticFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'StatisticService';
    }
}