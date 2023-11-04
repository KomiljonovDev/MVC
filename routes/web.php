<?php

    use core\Router;
    use Controllers\UserController;


    Router::get('url-2',UserController::class, 'func1');

?>