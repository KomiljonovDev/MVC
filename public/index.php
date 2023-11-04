<?php

    echo $_SERVER['SCRIPT_FILENAME'];
    use core\App;
    require '../autoload.php';


    $app = new App();
    $app->run();

?>