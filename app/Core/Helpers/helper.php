<?php

function view ($view, $params=[]) {
    extract($params);
    include "../resources/views/" . $view . ".blade.php";
}

function env () {
    $env = file_get_contents('../.env');
    echo $env;
}
env();
?>