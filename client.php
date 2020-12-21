<?php

$public = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDAaXVBP6646VnRu7wH4ZJ7hsRY
ctTYTAdj0GJc+vd1LWOhi95F8fEORU0kQxn+3780ixS5W1Lfetr1+dNl2TSnxF8E
/XHt+gkAtka15XJGKZg7QgfoZaHj6OSbpCyfrLY7bU0Ln2GqEeZMLCNt8sYNR/s7
aCMTFF2nJF7vl3UK7wIDAQAB
-----END PUBLIC KEY-----';

$ak = 'ABCDEFGHop123';
$sk = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNAD';

$url = 'http://www.testencrypt.com/server.php';

$params['appKey'] = $ak;
$params['ordeiId'] = 1;
$params['name'] = 'Peter';
$params['password'] = '123456';
$params['time'] = time();

$queryString = http_build_query($params);

$sign = sign($params, $sk);
$queryString = $queryString . '&sign=' . $sign;
$ret = openssl_public_encrypt($queryString, $encrypt, $public);
$data['q'] = $encrypt;

$t = curl_post($url, $data);
var_dump($t);

function curl_post($url , $data=array()){

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

    // POST数据

    curl_setopt($ch, CURLOPT_POST, 1);

    // 把post的变量加上

    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $output = curl_exec($ch);

    curl_close($ch);

    return $output;

}

function sign ($params, $sk) {
    ksort($params);
    $str = http_build_query($params);
    $str .= "&$sk";
    $sign = md5($str);
    return $sign;
}