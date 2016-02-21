<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 上午11:32
 */

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Debug\Debug;

$loader = require __DIR__.'/../app/autoload.php';

$input = new ArgvInput(['console', 'assetic:dump', '--env=saedev']);
$env = $input->getParameterOption(['--env', '-e'], getenv('SYMFONY_ENV') ?: 'dev');
$debug = getenv('SYMFONY_DEBUG') !== '0' && !$input->hasParameterOption(['--no-debug', '']) && $env !== 'prod';

if ($debug) {
    Debug::enable();
}

$kernel = new SaeAppKernel($env, $debug);
$application = new Application($kernel);

$os = fopen('saekv://var/logs/console.log', 'a');
$output = new \Symfony\Component\Console\Output\StreamOutput($os);

$application->run($input, $output);
