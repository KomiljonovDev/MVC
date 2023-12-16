<?php

namespace app\Controllers;

use app\Core\Model\Model;
use app\Models\User;


class Controller {
    public static function welcome ():void {
        return view('welcome',[
            'message'=>'Assalomu alaykum'
        ]);
    }
    public static function helloWorld ():void {
        return view('hello-world',[
            'message'=>'Assalomu alaykum'
        ]);
    }

    public static function  login() {
        return view('login');
    }

}