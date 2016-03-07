<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-3-7
 * Time: 下午3:26
 */
const GITHUB_REPO_URL = 'https://github.com/jasonz93/AGarage';

$header = getHeaders();
$payload = json_decode(file_get_contents('php://input'), true);

$log = fopen(__DIR__.'/../storage/logs/github_hook.log', 'a');

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
$projectPath = __DIR__.'/../';
writeLog($log, "Project dir is $projectPath");
chdir($projectPath);
$branch = explode('/', $payload['ref'])[2];
writeLog($log, "Push Branch: $branch");
$output = [];
exec('git status', $output);
$currentBranch = explode(' ', $output[0])[1];
writeLog($log, "Current Branch: $currentBranch");
$headCommit = $payload['head_commit'];
$repository = $payload['repository'];
if ($repository['url'] !== GITHUB_REPO_URL) {
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
$output = [];
writeLog($log, "Updating project from github...");
exec("git pull", $output);
writeLog($log, $output);
writeLog($log, "Updating composer dependencies...");
$output = [];
exec('composer update', $output);
writeLog($log, $output);
$output = [];
writeLog($log, "Migrating database...");
exec("php artisan migrate", $output);
writeLog($log, $output);
$output = [];
writeLog($log, "Running gulp...");
exec("gulp", $output);
writeLog($log, $output);

goto END;


END:
writeLog($log, "Github Hook done.");
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