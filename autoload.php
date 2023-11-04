<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

function view ($view, $params=[]) {
    extract($params);
    include "../resources/views/" . $view . ".blade.php";
}

spl_autoload_register(function ($className){
   require "../" . str_replace("\\", "/", $className) . ".php";
});


include "../routes/web.php";


?>