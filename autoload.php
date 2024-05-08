<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (file_exists("../app/Core/Helpers/helper.php")){
    include "../app/Core/Helpers/helper.php";
}else{
    include "./app/Core/Helpers/helper.php";
}

spl_autoload_register(function ($className){
    if (file_exists("../" . str_replace("\\", "/", $className) . ".php")){
        require "../" . str_replace("\\", "/", $className) . ".php";
        return;
    }
    require "./" . str_replace("\\", "/", $className) . ".php";
});




?>