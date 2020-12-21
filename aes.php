<?php
//    $method = openssl_get_cipher_methods();
//    var_dump($method);

//对称算法
    $method = 'aes-128-cbc';

    $a = 'ni shi sha bi!!!';

    $key = md5(uniqid());

    $iv1 = substr($key, 0, 16);
    $iv2 = substr($key, 16, 16);
//    var_dump($key);
//    var_dump($iv1);
//    var_dump($iv2);

    $iv = $iv1 ^ $iv2;
    $b = openssl_encrypt($a, $method, $key, OPENSSL_RAW_DATA, $iv);

    $c = openssl_decrypt($b, $method, $key, OPENSSL_RAW_DATA, $iv);
    print_r($key);
    echo "<br/>";
    print_r($c);
    echo "<br/>";
