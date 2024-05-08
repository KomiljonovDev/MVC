<?php

namespace app\Controllers;

use App\Core\database\Migration;
use app\Http\Request;
use app\Models\Devices;

class DeviceController {
    public static function getDevices () {
        Devices::insertInto([
            'name'=>'sdbscdcsdcbds',
            'lastname'=>'sdjcnsdbcshdbc',
            'token'=>'facvdcdscsfcgcfgftfgjcf'
        ]);
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