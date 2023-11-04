<?php

namespace core;

final class App {
    public static function run () {
        include "../routes/web.php";
        $routes = Router::allRoute();
        $request = Request::getRequestUrl();

        if (array_key_exists($request, $routes)){
            echo "ok";
        }
        print_r(json_encode($routes));
        print_r($request);

        echo $_SERVER['SCRIPT_FILENAME'];
    }
}