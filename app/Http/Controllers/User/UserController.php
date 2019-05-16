<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

use App\Model\UserModel;


class UserController extends Controller
{

    /**
     * 注册
     * @return array
     */
    public function reg()
    {
        $url = 'http://'.env('HOST_PASSPORT').'/api/user/reg';
        $response = $this->curlPost($url,$_POST);
        return $response;
    }

    /**
     * 登录
     * @param Request $request
     */
    public function login(Request $request)
    {
        $e = $request->input('u');
        $p = $request->input('p');
        $c = $request->input('c');      // 客户端标识 1 Android 2 Iphone 3 IPAD

        //验证用户
        $url = "http://".env('HOST_PASSPORT')."/api/user/login?u=$e&p=$p&c=$c";         // passport 验证登录接口
        return $this->curlGet($url);
    }

    /**
     * 个人中心
     */
    public function center()
    {
        $response = [
            'errno' => 0,
            'msg'   => 'ucenter'
        ];

        return $response;
    }


    /**
     * curl 请求
     */
    public function curlGet($url)
    {
        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

        $response = curl_exec($ch);
        $errno = curl_errno($ch);
        if($errno){
            $response = [
                'errno' => 50001,
                'msg'   => 'curl err : '.$errno
            ];
        }

        curl_close($ch);

        return $response;

    }


    /**
     * curl POST请求
     * @param $url
     * @param $param
     * @return array|bool|string
     */
    public function curlPost($url,$param)
    {
        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$param);

        $response = curl_exec($ch);
        $errno = curl_errno($ch);
        if($errno){
            $response = [
                'errno' => 50001,
                'msg'   => 'curl err : '.$errno
            ];
        }
        curl_close($ch);
        return $response;

    }

}
