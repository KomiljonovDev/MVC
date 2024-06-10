<?php

namespace app\Http;

use app\Http\Middleware\Middleware;

final class Router {
    private static $routes = [];
    public static function get ($url, $Controller) {
        self::$routes = array_merge(self::$routes, [Request::scriptName() . $url => ['Controller'=>$Controller[0], 'Method'=>$Controller[1], 'type'=>'GET']]);
        return self::$routes;
    }
    public static function post ($url, $Controller) {
        self::$routes = array_merge(self::$routes, [Request::scriptName() . $url => ['Controller'=>$Controller[0], 'Method'=>$Controller[1], 'type'=>'POST']]);
        return self::$routes;
    }
    public static function put ($url, $Controller) {
        self::$routes = array_merge(self::$routes, [Request::scriptName() . $url => ['Controller'=>$Controller[0], 'Method'=>$Controller[1], 'type'=>'PUT']]);
        return self::$routes;
    }
    public static function patch ($url, $Controller) {
        self::$routes = array_merge(self::$routes, [Request::scriptName() . $url => ['Controller'=>$Controller[0], 'Method'=>$Controller[1], 'type'=>'PATCH']]);
        return self::$routes;
    }
    public static function delete ($url, $Controller) {
        self::$routes = array_merge(self::$routes, [Request::scriptName() . $url => ['Controller'=>$Controller[0], 'Method'=>$Controller[1], 'type'=>'DELETE']]);
        return self::$routes;
    }
    public static function routeAll () {
        return self::$routes;
    }

    // Middleware
    public static function middleware ($middleware=null) {
        $allMiddleware = Middleware::all();
        if ($middleware){
            if (array_key_exists($middleware,$allMiddleware)){
                call_user_func_array([$allMiddleware[$middleware], 'handle'], [new Request()]);
                return new Middleware;
            }
        }
    }
}
