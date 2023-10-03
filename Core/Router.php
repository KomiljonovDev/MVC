<?php

class Router {
    private static  $routes = [];

    public static function get (string $url, $controller) {
        self::$routes = array_merge(self::$routes, [$uri => ['controller'=>$controller, 'type'=>'GET']]);
        $controller();
    }
}