<?php

use app\Controllers\DeviceController;
use app\Http\Router;


Router::get('getDevices', [DeviceController::class, 'getDevices']);
Router::get('login', [DeviceController::class, 'login']);


