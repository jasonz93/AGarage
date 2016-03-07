<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2016/3/7
 * Time: 23:57
 */

namespace AGarage\Facades;


use Illuminate\Support\Facades\Facade;

class UtilsFacade extends Facade
{
    public static function getFacadeAccessor() {
        return 'Utils';
    }
}