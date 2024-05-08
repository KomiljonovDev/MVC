<?php

namespace app\Core;

use app\Http\Request;
use app\Http\Router;
use \app\Http\Response as HttpResponse;

final class Response {
    public static function run () {
        $request = Request::currentUrl();
        $routes = Router::routeAll();
        if (array_key_exists($request, $routes)) {
            $Controller = $routes[$request];
            if (Request::getMethod() == $Controller['type']) {
                $className = new $Controller['Controller'];
                $classMethod = $Controller['Method'];
                $response = call_user_func_array([$className, $classMethod], Request::params());
                if (gettype($response)=='array' || gettype($response) == 'object'){
                    \app\Http\Response::setHttpstatus(200);
                    \app\Http\Response::setHeader('Content-type', 'json');
                    echo json_encode($response,JSON_PRETTY_PRINT);
                    return  true;
                }
                echo $response;
                return true;
            }
            HttpResponse::setHttpstatus(405);
            return HttpResponse::errorPage();
        }
        HttpResponse::setHttpstatus(404);
        return HttpResponse::errorPage();
    }
}
