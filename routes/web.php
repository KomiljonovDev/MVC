<?php

use app\Controllers\DeviceController;
use app\Core\Response;
use app\Http\Router;


Router::get('getDevices', [DeviceController::class, 'getDevices']);
Router::get('login', [DeviceController::class, 'login']);

Response::run();

?>