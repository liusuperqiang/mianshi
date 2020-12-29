<?php
//创建Server对象，监听 127.0.0.1:9501 端口
$server = new Swoole\Server('127.0.0.1', 9501, SWOOLE_PROCESS, SWOOLE_SOCK_TCP);

$server->set([
    'reactor_num'   => 2,
    'worker_num'    => 4,
    'max_request'   => 50
]);

//监听连接进入事件
/**
 *
 */
$server->on('Connect', function ($server, $fd, $reactor_id) {
    echo "Client-$fd-$reactor_id: Connect.\n";
});

//监听数据接收事件
$server->on('Receive', function ($server, $fd, $from_id, $data) {
    $server->send($fd, "Server: " . $data);
});

//监听连接关闭事件
$server->on('Close', function ($server, $fd) {
    echo "Client: Close.\n";
});

//启动服务器
$server->start();

