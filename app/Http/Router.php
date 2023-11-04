<?php

namespace app\Http;

final class Router {
    private static $routes = [];
    public static function get ($url, $Controller) {
        self::$routes = array_merge(self::$routes, [$url => ['Controller'=>$Controller[0], 'method'=>$Controller[1], 'type'=>'GET']]);
        return self::$routes;
    }
    public static function currentUrl () {
        return $_SERVER['REQUEST_URI'];
    }
}
