<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-20
 * Time: 上午2:36
 */

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->get('/v1/site', function (Request $request, Response $response) {
    $config = new \AGarage\V1\Site\Models\SiteConfig();
    $config->name = 'siteName';
    $config->value = '一间车库';
    $config2 = new \AGarage\V1\Site\Models\SiteConfig();
    $config2->name = 'test';
    $config2->value = 'testVal';
    $res = new \AGarage\V1\Common\Models\APIResponse();
    $res->data = array($config, $config2);
    return $res->inject($response);
});