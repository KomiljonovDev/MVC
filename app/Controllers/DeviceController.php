<?php

namespace app\Controllers;

use app\Http\Request;

class DeviceController {
    public static function getDevices () {
        return Request::getHeaders();
    }
    public static function welcome ():void {
        view('welcome',[
            'message'=>'Assalomu alaykum, welcome'
        ]);
    }
    public static function helloWorld ():void {
        view('hello-world',[
            'message'=>'Assalomu alaykum'
        ]);
    }

    public static function  login() {
        view('login');
    }

}