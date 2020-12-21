<?php
$private = '-----BEGIN PRIVATE KEY-----
MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAMBpdUE/rrjpWdG7
vAfhknuGxFhy1NhMB2PQYlz693UtY6GL3kXx8Q5FTSRDGf7fvzSLFLlbUt962vX5
02XZNKfEXwT9ce36CQC2RrXlckYpmDtCB+hloePo5JukLJ+stjttTQufYaoR5kws
I23yxg1H+ztoIxMUXackXu+XdQrvAgMBAAECgYBv72nlUZTlwesc1mhm9VVwQ1CK
XBNy2Zga+ymeCepX4tXpLyNZ8YxYzvw3skm3OpdTi+28f2JQ3HnxSysuPxQf2kzg
pOwcmeqg0AIJjesicuLsm9bxwyNODpxagZE1ecE3srhvJ8cXTtw9CCkm1AUSZWVp
xcC5c+bg+yoX+fJzYQJBAPCcsEvplW9tpHLeHC9R/Jwi86MhNCpOR072t8GO8Bva
s2oA7uX4aXMTXY0PqBiRw65ao7j4P4j2ThDkH7nhP3kCQQDMt6KHvGn1d8SrtQdY
7FPTY1CgZRM3MlplZ7LUPDkx3lQHbr8wUx0ngkpvERgEetrcMmlwmPbVCJX9jl7f
UfunAkEAmS9onivsU7C+TdNSpl3QMaee7XCqQXTsuT0h6D0UaOdn6kkFz6vDltvx
Z2lcX6gNqOdT7OM/r/b/5IkYGcNqIQJAJIzg2uU78dSpa5LNtgWzzbkcqxaAwMkf
tJ04I4aBG7M7Q3x1bDZarTQo//2IUTxyGQBzLORSpaR7yyKBM9QaXwJBANpLIS74
I4uJyVlXu2dhuSGfq2xE5r0NwynFS98j95tz+IkRxhn8OeSSODKjdutZHPjK9Ikg
OoxvvOUXOzsQKTo=
-----END PRIVATE KEY-----';

    $str = $_POST;
    $r = openssl_private_decrypt($str['q'], $decrypt, $private);
    $params = [];
    //parse_str()解析URL参数成为数组
    parse_str($decrypt, $params);

    $sign = getSign($params);
    if ($sign != $params['sign']) {
        echo 'sign error';die;
    }
    echo 'SUCCESS';

    function getSign ($params)
    {
        $conf = [
          'ABCDEFGHop123' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNAD'
        ];

        /**
         * abs()取绝对值
         * 防止请求超时
         */
        if (abs($params['time'] - time()) >= 600) {
            die('time out');
        }

        unset($params['sign']);
        ksort($params);
        $str = http_build_query($params);
        $sign = md5($str . '&' . $conf[$params['appKey']]);
        return $sign;
    }
