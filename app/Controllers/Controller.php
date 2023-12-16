<?php

namespace app\Controllers;

use app\Core\Model\Model;
use app\Models\User;


class Controller {
    public static function welcome ():void {
        view('welcome',[
            'message'=>'Assalomu alaykum'
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