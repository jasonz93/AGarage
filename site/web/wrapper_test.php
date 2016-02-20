<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 上午5:12
 */

require_once __DIR__ . '/../app/wrapper.php';

//var_dump(@file_put_contents('mysaemc:///var/cache/saedev/classes.php', 'test content') && @rename('mysaemc:///var/cache/saedev/classes.php', 'mysaemc:///var/cache/saedev/classes.php1'));

//var_dump(@rename('mysaemc://test.txt', 'mysaemc://test1.txt'));

var_dump(@file_put_contents(tempnam('aaa', 'bbb'), 'test'));