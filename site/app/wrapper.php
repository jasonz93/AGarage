<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 上午4:40
 */

class MySaeMemcacheWrapper extends SaeMemcacheWrapper {
    public function stream_metadata($path, $option, $value) {
        return false;
    }
}

if ( in_array( "saemc", stream_get_wrappers() ) ) {
    stream_wrapper_unregister("saemc");
}
stream_wrapper_register( "saemc", "MySaeMemcacheWrapper" );


class MySaeKVWrapper extends SaeKVWrapper {
    public function stream_metadata($path, $option, $value) {
        return false;
    }
}

if ( in_array("saekv", stream_get_wrappers()) ) {
    stream_wrapper_unregister("saekv");
}
stream_wrapper_register("saekv", "MySaeKVWrapper");