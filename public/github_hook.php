<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-3-7
 * Time: 下午3:26
 * 一个简单的Github Hook，可以在接收到push事件的时候pull最新的代码并执行设定的命令。
 * pull代码前判断了该push事件对应的分支，如果与本地项目当前分支不同则不执行任何操作。
 * 配置文件说明:
 * {
 *      "repoUrl": "https://github.com/jasonz93/AGarage",   //项目的Github地址
 *      "projectRootRelative": "../",   //任务命令工作目录相对于脚本文件的相对路径（一般是项目根目录）
 *      "output": "storage/logs/ghook.log",   //输出的日志文件（相对于projectRootRelative的相对路径）
 *      "tasks": [
 *          {
 *              "preMsg": "Updating composer dependencies...",  //任务开始前打印的信息
 *              "command": "composer update",   //任务执行的命令
 *              "postMsg": ""   //任务结束后打印的信息
 *          }
 *      ]
 * }
 */

fastcgi_finish_request();

$config = json_decode(file_get_contents(__DIR__.'/ghook.json'), true);
$projectPath = __DIR__."/{$config['projectRootRelative']}";
$outputFile = $projectPath.$config['output'];

$header = getHeaders();
$payload = json_decode(file_get_contents('php://input'), true);

$log = fopen($outputFile, 'a');

$event = $header['x-github-event'];

switch ($event) {
    case 'ping':
        writeLog($log, 'Got a ping.');
        goto END;
    case 'push':
        writeLog($log, 'Got a push.');
        goto HANDLE_PUSH_EVENT;
    default:
        writeLog($log, "Got an unknown event: $event .");
        writeLog($log, json_encode($payload, JSON_PRETTY_PRINT));
        goto END;
}

HANDLE_PUSH_EVENT:
$branch = explode('/', $payload['ref'])[2];
writeLog($log, "Push Branch: $branch");
$output = [];
exec('git status', $output);
$currentBranchArr = explode(' ', $output[0]);
$currentBranch = $currentBranchArr[count($currentBranchArr) - 1];
writeLog($log, "Current Branch: $currentBranch");
$headCommit = $payload['head_commit'];
$repository = $payload['repository'];
if ($repository['url'] !== $config['repoUrl']) {
    writeLog($log, "Not this repository.");
    goto END;
}
if ($currentBranch !== $branch) {
    writeLog($log, "Not current branch.");
    goto END;
}
if (count($headCommit['added']) + count($headCommit['removed']) + count($headCommit['modified']) == 0) {
    writeLog($log, "No file changed.");
    goto END;
}

shell_exec('nohup php ghook_worker.php &');
writeLog($log, "Github Hook worker started.");

goto END;


END:
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
    if (is_string($content)) {
        $lines = explode("\n", $content);
    } else if (is_array($content)) {
        $lines = $content;
    } else {
        return;
    }
    $date = date('Y-m-d H:i:s');
    foreach ($lines as $line) {
        fprintf($resource, "%s --- %s\n", $date, $line);
    }
};