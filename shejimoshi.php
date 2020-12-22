<?php
/**
 * 设计模式
 *
 * 多态：在面向对象中，指某种对象实例的不同表现形式
 */
//抽象类不能实例化，只能被继承  抽象类中的抽象方法必须要在子类中实现  抽象方法不必实现具体的功能，由子类来完成  抽象方法没有方法体
abstract Class Tiger {
    abstract public function climb ();
}

Class MTiger extends Tiger
{
    public function climb()
    {
        // TODO: Implement climb() method.
        echo '孟加拉虎';
    }
}

Class XTiger extends Tiger
{
    public function climb()
    {
        // TODO: Implement climb() method.
        echo '西伯利亚虎';
    }
}

Class Client {
    public static function call($animal)
    {
            $animal->climb();
    }
}

Class Cat
{
    public function climb ()
    {
        echo '是只猫';
    }
}

Client::call(new MTiger());
Client::call(new XTiger());
Client::call(new Cat());

/**
 * 简单工厂模式   减少new
 */
//接口中所有的方法都是抽象方法，而且不需要在方法前使用 abstract 关键字进行修饰
//接口不能进行实例化操作，所以要使用接口中的成员，就必须借助子类。在子类中继承接口需要使用 implements 关键字，如果要实现多个接口的继承，那么每个接口之间使用逗号,分隔
//一个类可以实现多个接口，一个类只能继承一个父类
interface db {
    function conn();
}

Class Mysql implements db
{
    public function conn()
    {
        // TODO: Implement conn() method.
        echo 'mysql连接成功';
    }
}

$db = new Mysql();
$db->conn();


























