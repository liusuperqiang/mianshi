<?php
//链接服务器
$client =  new Swoole\Client(SWOOLE_SOCK_TCP);

if (!$client->connect('127.0.0.1', 9501, -1)) {
    exit("connect failed. Error: {$client->errCode}\n");
}

//php cli常量
fwrite(STDOUT, '请输入消息：');
$msg = trim(fgets(STDIN));

//发送消息给服务端
$client->send($msg);

//接受服务器数据
$ser = $client->recv();
echo $ser;
