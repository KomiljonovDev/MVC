<?php

use app\Controllers\Controller;
use app\Core\Response;
use app\Http\Router;

Router::get('', [Controller::class, 'welcome']);
Router::get('url', [Controller::class, 'helloWorld']);

Response::run();

?>