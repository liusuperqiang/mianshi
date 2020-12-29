<?php
/**
 * websocket服务特点
 * 1、建立在tcp协议之上
 * 2、性能开销小通信高效
 * 3、客户端可以与任意服务器通信
 * 4、协议标识符ws、wss
 * 5、持久化网络通信协议（长链接
 */

class Ws {
    protected $host = '0.0.0.0';
    protected $port = 8812;

    protected $ws = null;

    public function __construct()
    {
        $this->ws = new Swoole\WebSocket\Server($this->host, $this->port);
        //配置服务器
        $this->ws->set([
                'task_worker_num' => 4,
                'worker_num' => 2
            ]);
        $this->ws->on('open', [$this, 'onOpen']);
        $this->ws->on('message', [$this, 'onMessage']);
        $this->ws->on('task', [$this, 'onTask']);
        $this->ws->on('finish', [$this, 'onFinish']);
        $this->ws->on('close', [$this, 'onClose']);

        $this->ws->start();
    }

    //监听open事件
    public function onOpen ($ws, $request)
    {
        var_dump($request->fd);
        if ($request->fd == 1) {
            Swoole\Timer::tick(2000, function() use ($request) {
                echo "clinet-id:" . $request->fd . PHP_EOL;
            });
        }
    }

    //监听message
    public function onMessage ($ws, $frame)
    {
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";

        $data = ['msg' => $frame->data, 'client_id' => $frame->fd];
        //投递异步任务
        $task_id = $ws->task($data);
        var_dump('投放任务id:' . $task_id);

        //定时器
        Swoole\Timer::after(5000, function() use ($ws, $frame) {
            $ws->push($frame->fd, 'server-time-after:' . date('Y-m-d H:i:s'));
        });

        $ws->push($frame->fd, "this is server, send message. time: " . date('Y-m-d H:i:s'));
    }

    //处理异步任务
    public function onTask ($ws, $task_id, $from_id, $data)
    {
        echo "New AsyncTask[id=$task_id]".PHP_EOL;
        echo "from_id [id=$from_id]".PHP_EOL;
        //耗时
        sleep(10);
        return 'task handle finished!';
    }

    //处理异步任务结果
    public function onFinish ($ws, $task_id, $data)
    {
        echo "AsyncTask[$task_id] Finish: $data".PHP_EOL;
    }

    public function onClose ($ws, $fd)
    {
        echo 'close:' . $fd . '\n';
    }
}

$o = new Ws();
