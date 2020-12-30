<?php

echo 'process-start-time' . date('Ymd His') . PHP_EOL;

$workers = [];
$urls = [
    'http://www.baidu.com',
    'http://www.sina.com',
    'http://www.qq.com',
    'http://www.baidu.com?search=123',
    'http://www.baidu.com?search=456',
    'http://www.baidu.com?search=789',
    'http://www.baidu.com?search=135',
    'http://www.baidu.com?search=246',
];

foreach ($urls as $url) {
    $process = new swoole\process(function (swoole\process $worker) use ($url) {
        //把内容存到管道中
        $content = urlsData($url);
        echo $content . PHP_EOL;
    }, true);
    $pid = $process->start();
    //存储进程对象
    $workers[$pid] = $process;
}

////输出管道中的内容
foreach ($workers as $process) {
    echo $process->read();
}

function urlsData ($url) {
    //逻辑处理  模拟场景
    sleep(1);
    return $url . 'success' . PHP_EOL;
}

echo 'process-end-time' . date('Ymd His') . PHP_EOL;