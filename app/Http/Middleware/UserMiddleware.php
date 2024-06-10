<?php

namespace app\Http\Middleware;

use app\Http\Request;
use app\Http\Response;
use app\Models\User;

class UserMiddleware extends Middleware {
    public static function handle(Request $request) {
        $user = User::selectWhere([['token' => $request::getHeaders('token'), 'cn' => '=']]);
        if (!$user){
            Response::redirect('/login');
        }
        return self::class;
    }
}