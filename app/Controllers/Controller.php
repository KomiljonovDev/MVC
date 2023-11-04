<?php

namespace app\Controllers;

class Controller {
    public static function index ():void {
        view('welcome',[
            'message'=>'Assalomu alaykum'
        ]);
    }

}