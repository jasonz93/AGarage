<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-3-5
 * Time: 下午9:24
 */

namespace AGarage\Facades;


use Illuminate\Support\Facades\Facade;

class ParsedownFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ParsedownService';
    }
}