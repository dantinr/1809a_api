<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;


class TestController extends Controller
{

    public function testSec()
    {
        $enc_str = file_get_contents("php://input");
        echo $enc_str;echo '<hr>';

        //解密
        $method = 'AES-256-CBC';
        $pass = 'xxyyzz';
        $iv = '1809a1809a1809aa';

        $d64 = base64_decode($enc_str);
        $dec_data = openssl_decrypt($d64,$method,$pass,OPENSSL_RAW_DATA,$iv);
        echo $dec_data;die;
        //TODO 业务逻辑

    }

    /**
     * 非对称加密
     */
    public function testRsa()
    {
        $enc_str = file_get_contents('php://input');

        //解密数据
        $d64 = base64_decode($enc_str);
        //echo $d64;

        $pk = openssl_get_publickey('file://'.storage_path('app/keys/public.pem'));
        openssl_public_decrypt($d64,$dec_data,$pk);

        echo $dec_data;
    }

    public function testSign()
    {

        echo '<pre>';print_r($_GET);echo '</pre>';
        $str = file_get_contents("php://input");
        echo 'json: '.$str;echo '</br>';echo '<hr>';

        $rec_sign = $_GET['sign'];      //接收到的签名
        $pk = openssl_get_publickey('file://'.storage_path('app/keys/public.pem'));
        //验签
        $rs = openssl_verify($str,base64_decode($rec_sign),$pk);
        if($rs != 1){
            die("验签错误");
        }else{
            "OK";
        }

    }

    public function testCors()
    {
        echo __METHOD__;
    }

    public function redisTest()
    {
        $k = 'abc';
        $v = 'aaaaa';

        Redis::set($k,$v);
        echo Redis::get($k);
    }

    public function q()
    {
        return response('xixi',200);
    }
}
