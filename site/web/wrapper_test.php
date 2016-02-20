<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 上午5:12
 */

require_once __DIR__ . '/../app/wrapper.php';

var_dump(@file_put_contents('mysaemc://test.txt', 'test content'));

var_dump(@rename('mysaemc://test.txt', 'mysaemc://test1.txt'));