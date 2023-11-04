<?php

    spl_autoload_register(function ($file_name){
        include "../" . str_replace("\\", '/', $file_name). ".php";
    });

?>