<?php

namespace core;

final class Router {
    private static array $routes = [];

    public static function currentURL () {

    }
    public static function get ($url,$controller): void {
        self::$routes = array_merge(self::$routes, [$url => ['controller'=> $controller, 'type'=>'GET']]);
    }

    public static function post ($url, $controller):void {
        self::$routes = array_merge(self::$routes, [$url => ['controller'=> $controller, 'type'=>'POST']]);
    }

    public static function allRoute () {
        return self::$routes;
    }
}