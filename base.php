<?php

class Base
{
    private static $redisObj;

    public static function conRedis($config = array())
    {
        if (self::$redisObj) return self::$redisObj;
        self::$redisObj = new \Redis();
        self::$redisObj->connect("127.0.0.1", 6379);
        return self::$redisObj;
    }

    /*static function output($data = array(), $errNo = 0, $errMsg = 'ok')
    {
        $res['errno'] = $errNo;
        $res['errmsg'] = $errMsg;
        $res['data'] = $data;
        echo json_encode($res);exit();
    }*/

    //单例模式防止被克隆
    private function __clone(){}
}

/**
 * 两个对象是同一个对象时才全等
 * 方法前加final，则方法不能被覆盖；类前加final，则类不能被继承
 *
 * 面向对象的三大特性：封装、继承、多态
 */

$s1 = Base::conRedis();
/*if ($s1 === $s2) {
    echo '是同一个对象';
} else {
    echo '不是同一个对象';
}*/
?>
