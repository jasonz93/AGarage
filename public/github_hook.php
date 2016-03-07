<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-3-7
 * Time: 下午3:26
 */

$header = getHeaders();
$payload = json_decode(file_get_contents('php://input'));

$log = fopen(__DIR__.'/../storage/logs/github_hook.log', 'a');

$event = $header['x-github-event'];

switch ($event) {
    case 'ping':
        writeLog($log, 'Got a ping.');
        break;
    default:
        writeLog($log, "Got an unknown event: $event .");
        break;
}

fclose($log);

/**
 * 获取HTTP头
 * @return array
 */
function getHeaders() {
    $headers = [];
    foreach ($_SERVER as $key => $value) {
        if (substr($key, 0, 5) === 'HTTP_') {
            $key = substr($key, 5);
            $key = str_replace('_', '-', $key);
            $key = strtolower($key);
            $headers[$key] = $value;
        }
    }
    return $headers;
}

function writeLog($resource, $content) {
    $lines = explode("\n", $content);
    $date = date('Y-m-d H:i:s');
    foreach ($lines as $line) {
        fprintf($resource, "%s --- %s\n", $date, $line);
    }
}