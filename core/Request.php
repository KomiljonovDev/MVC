<?php

namespace core;

class Request {
    public static function getRequestUrl () {
        return explode("?", filter_var(trim($_SERVER['REQUEST_URI'], "/"), FILTER_SANITIZE_URL))[0];
    }

    public static function getRequestMethod () {
        return $_SERVER['REQUEST_METHOD'];
    }
}