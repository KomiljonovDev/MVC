<?php

    spl_autoload_register(function ($className){
       require "../" . str_replace("\\", "/", $className) . ".php";
    });


?>