<?php

$http = new Swoole\Http\Server("localhost", 8811);

$http->set([
    'document_root' => '/www/swoole/demo', // v4.4.0以下版本, 此处必须为绝对路径
    'enable_static_handler' => true,
]);

$http->on('request', function ($request, $response) {
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999). $request->get['m'] . "</h1>");
});

$http->start();
