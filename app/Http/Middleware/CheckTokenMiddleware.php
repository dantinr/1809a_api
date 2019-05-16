<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class CheckTokenMiddleware
{
    /**
     * 检查请求 token
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory|mixed
     */
    public function handle($request, Closure $next)
    {

        if(!isset($_GET['c']) || !isset($_GET['u']) || !isset($_GET['token'])){
            die(json_encode(['errno'=>40003,'msg'=>'Param wrong']));
        }else{
            //验证token
            $c = $_GET['c'];
            $u = $_GET['u'];
            $token = $_GET['token'];        // 客户端传过来
            $key = '1809a_str:app:plat:' .$c. ':login_token:uid:' .$u;

            $cache_token = Redis::get($key);

            if($cache_token){       //能取到 redis的token
                if($cache_token == $token){

                }else{
                    die(json_encode(['errno'=>40004,'msg'=>'token not match']));
                }
            }else{
                die(json_encode(['errno'=>40005,'msg'=>'token expired']));
            }
        }

        return $next($request);
    }
}
