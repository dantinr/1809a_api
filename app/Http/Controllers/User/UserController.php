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
        $response = [
            'errno' => 0,
            'msg'   => '注册成功',
            'data'  => []
        ];

        return $response;
    }

    /**
     * 登录
     * @param Request $request
     */
    public function login(Request $request)
    {
        $e = $request->input('e');
        $p = $request->input('p');

        $u = UserModel::where(['email'=>$e])->first();
        //TODO 验证密码


        $response = [
            'errno' => 0,
            'msg'   => 'ok',
            'data'  => [
                'token' => 'abcdef'
            ]
        ];

        return $response;

    }

    /**
     * 个人中心
     */
    public function center()
    {
        $uid = $_GET['uid'];
        $u = UserModel::where(['uid'=>$uid])->first();
    }
}
