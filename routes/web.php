<?php

use app\Controllers\DeviceController;
use app\Controllers\UserController;
use app\Http\Router;

Router::get('getDevices', [DeviceController::class, 'getDevices']);
Router::get('login', [UserController::class, 'login']);
Router::get('signup', [UserController::class, 'signup']);
