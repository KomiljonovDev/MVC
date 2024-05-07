<?php

use app\Controllers\Controller;
use app\Controllers\User;
use app\Core\Response;
use app\Http\Router;
use \app\Http\Request;
use app\Core\Model\Devices;


Router::get('signup', [Controller::class, 'signup']);
Router::get('url', [Controller::class, 'helloWorld']);
Router::get('login', [Controller::class, 'login']);
Router::get('dashboard', [User::class, 'getUserName']);

Response::run();

?>