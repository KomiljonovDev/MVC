<?php

namespace app\Http;

class Request {
    public static function currentUrl () {
        return $_SERVER['REQUEST_URI'];
    }

    public static function scriptName () {
        return str_replace('index.php', '', $_SERVER["SCRIPT_NAME"]);
    }

    public static function getMethod () {
        return $_SERVER['REQUEST_METHOD'];
    }
    public static function params () {
        return $_REQUEST;
    }
}
