<?php

/**
 * innodb和myisam的区别
 * 1、innodb支持事务，myisam不支持事务
 * 2、myisam适合查询以及插入为主；innodb适合频繁修改以及涉及到安全的应用
 * 3、innodb支持外键，myisam不支持
 * 4、myisan是默认引擎，innodb需要设置
 * 5、innodb不支持全文索引
 * 6、innodb支持主键索引，myisam不支持主键
 * 7、innodb支持行锁
 */
