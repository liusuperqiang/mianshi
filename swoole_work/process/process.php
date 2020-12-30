<?php

$process = new swoole\process(function (Swoole\Process $worker) {

    $worker->exec('/home/work/study/php/bin/php', [__DIR__ . '/../server/http_server.php']);
}, true);

$pid = $process->start();
echo $pid . PHP_EOL;

//进程回收
Swoole\Process::wait();
