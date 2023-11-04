<?php

namespace app\Core;

use app\Http\Request;
use app\Http\Router;

final class Response {
    public static function run () {
        $request = Request::currentUrl();
        $routes = Router::routeAll();
        if (array_key_exists($request, $routes)) {
            $Controller = $routes[$request];
            $className = new $Controller['Controller'];
            $classMethod = $Controller['Method'];
            call_user_func_array([$className, $classMethod], Request::params());
        }else{
            \app\Http\Response::setHttpstatus(501);
            return \app\Http\Response::errorPage();
        }
    }
}
