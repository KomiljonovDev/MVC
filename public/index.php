<?php

    require "../autoload.php";

    use app\Controllers\Controller;
    use app\Core\Response;
    use app\Http\Router;

    Router::get('url', [Controller::class, 'index']);
    Response::run();

?>