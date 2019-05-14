<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;


class UserController extends Controller
{

    public function reg()
    {
        $response = [
            'errno' => 0,
            'msg'   => 'ok'
        ];

        return $response;
    }
}
