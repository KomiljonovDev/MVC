<?php

namespace app\Controllers;

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

}