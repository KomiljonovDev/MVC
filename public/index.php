<?php

    require "../autoload.php";

    use app\Http\Router;
    use app\Http\Request;
    use app\Controllers\Controller;
    use app\Http\Run;


    print_r(Run::test());
//    print_r(Router::get('url', [Controller::class, 'index']));

?>