<?php

namespace app\Controllers;

use App\Core\database\Migration;
use app\Http\Request;
use app\Models\Devices;

class DeviceController {
    public static function getDevices () {
        return Devices::selectAll();
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