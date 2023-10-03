<?php
class Request {
    public static function getRequestUrl () {
        return explode("?", filter_var(trim($_SERVER['REQUEST_URI'], "/")), FILTER_SANITIZE_URL)[0];
    }

}

$request = new Request();

echo ($request->getRequestUrl());

include "./Router.php";

Router::get('test', function () {
    echo "test";
    return "test";
});