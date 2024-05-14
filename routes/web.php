<?php

use app\Controllers\DeviceController;
use app\Controllers\UserController;
use app\Http\Router;


Router::post('signup', [UserController::class, 'signup']);
Router::post('login', [UserController::class, 'login']);
Router::post('delete', [UserController::class, 'deleteUser']);
Router::get('getDevices', [DeviceController::class, 'getDevices']);
