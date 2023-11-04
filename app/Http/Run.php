<?php

namespace app\Http;

class Run {
    public static function test () {
        return Router::currentUrl();
    }
}