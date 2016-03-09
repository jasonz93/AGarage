<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-3-10
 * Time: 下午3:26
 */

usleep(300);

$config = json_decode(file_get_contents(__DIR__.'/ghook.json'), true);
$projectPath = __DIR__."/{$config['projectRootRelative']}";
$outputFile = $projectPath.$config['output'];

$log = fopen($outputFile, 'a');

chdir($projectPath);
$output = [];
writeLog($log, "Updating project from github...");
exec("git pull", $output);
writeLog($log, $output);

$tasks = $config['tasks'];
foreach ($tasks as $task) {
    writeLog($log, $task['preMsg']);
    $output = [];
    exec($task['command'], $output);
    writeLog($log, $output);
    writeLog($log, $task['postMsg']);
}

goto END;


END:
writeLog($log, "Github Hook done.");
fclose($log);


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