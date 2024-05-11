<?php

namespace app\Controllers;

use app\Models\Devices;

class DeviceController extends Controller {
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
        Devices::selectWhere([
            [
                'id'=>2,
                'cn'=>'='
            ]
        ]);
        view('login',[
            'lastname'=>Devices::fetch()['name']
        ]);
    }

}