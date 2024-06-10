<?php

namespace app\Http\Middleware;

class Middleware {

    public static function group ($callback) {
        return $callback();
    }
    public static function all () {
        return [
            'user'=>UserMiddleware::class,
            'aut'=>'sds'
        ];
    }
}