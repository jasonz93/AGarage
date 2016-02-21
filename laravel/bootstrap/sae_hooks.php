<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 下午7:29
 */

function is_sae() {
    return isset($_SERVER['HTTP_APPNAME']);
}

if (is_sae()) {

//    function putenv() {
//
//    }
//
//    function getenv() {
//
//    }
}