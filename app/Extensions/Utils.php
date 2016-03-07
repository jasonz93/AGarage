<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2016/3/7
 * Time: 23:55
 */

namespace AGarage\Extensions;


class Utils
{
    public function getMilliTimestampDouble() {
        list($t1, $t2) = explode(' ', microtime());
        return (double)((doubleval($t1)+doubleval($t2)))*1000;
    }
}