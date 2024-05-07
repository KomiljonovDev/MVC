<?php

namespace app\Controllers;


use app\Core\Model\Devices;

class Controller {

    public static function signup () {
        echo json_encode(Devices::selectAll(), JSON_PRETTY_PRINT);
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