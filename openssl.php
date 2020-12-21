<?php

//非对称加密
    $public = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDAaXVBP6646VnRu7wH4ZJ7hsRY
ctTYTAdj0GJc+vd1LWOhi95F8fEORU0kQxn+3780ixS5W1Lfetr1+dNl2TSnxF8E
/XHt+gkAtka15XJGKZg7QgfoZaHj6OSbpCyfrLY7bU0Ln2GqEeZMLCNt8sYNR/s7
aCMTFF2nJF7vl3UK7wIDAQAB
-----END PUBLIC KEY-----';

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

    $data = '24f37422c9fb355fe1a7e331e537b794';

    $encrypt = '';
    //用私钥进行加密
    $ret = openssl_public_encrypt($data, $encrypt, $public);
    var_dump($ret);
    var_dump($encrypt);

    $decrypt = '';
    //用公钥进行解密
    $row = openssl_private_decrypt($encrypt, $decrypt, $private);
    var_dump($row);
    var_dump($decrypt);

    //变量作用域
    $a = 1;
    function test (&$a)
    {
        $a = 2;
        return true;
    }
    test($a);
    var_dump($a);
