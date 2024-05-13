<?php

namespace app\Controllers;

use app\Http\Request;
use app\Http\Response;
use app\Models\Devices;

class DeviceController extends Controller {
    public static function getDevices () {
        return Devices::selectAll();
    }
}