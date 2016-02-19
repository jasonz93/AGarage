<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-20
 * Time: 上午12:00
 */

require 'vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new Slim\App();

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("Hello world! Here is a garage.");
    return $response;
});

$app->run();