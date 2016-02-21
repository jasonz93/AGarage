<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 下午7:29
 */

function is_sae() {
    return function_exists('sae_debug');
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