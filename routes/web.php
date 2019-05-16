<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->post('/test/sec', 'Test\TestController@testSec');
$router->post('/test/rsa', 'Test\TestController@testRsa');      //非对称加密

$router->post('/test/sign', 'Test\TestController@testSign');      //非对称加密

$router->get('/test/cors', 'Test\TestController@testCors');
$router->get('/test/redis', 'Test\TestController@redisTest');
$router->get('/test/q', 'Test\TestController@q');


//用户接口
$router->post('/user/reg', 'User\UserController@reg');       //注册
$router->post('/user/login', 'User\UserController@login');       //登录
$router->get('/user/center', 'User\UserController@center');       //个人中心

