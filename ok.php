<?php

    include './app/Core/Helpers/helper.php';

    $command = strtolower($argv[1]);

    if (!$command) {
        die("Quyidagi buyruqlardan biridan foydalaning:");
    }
    if ($command == "configuration") {
        echo "Konfiguratsiya boshlanmoqda...";
        if (!file_exists("./App/Controllers/")) mkdir("./App/Controllers/");
        if (!file_exists("./App/Models/")) mkdir("./App/Models");
        if (!file_exists("./resources/Views")) mkdir("./resources/Views");

        echo "\nKonfiguratsiya nixoyasiga yetdi";
    }
    if (mb_stripos($command, ":")) {
        $data = explode(":", $command);
        $method = $data[0];
        $parametr = $data[1];
        $name = $argv[2];
        print_r($data);
        if ($method == "make") {
            if ($parametr == 'controller') {
                if (file_exists('./App/Controllers/' . ucfirst($name) . ".php")) die(ucfirst($name) . " Controller avvaldan mavjud.");

                $ModelName = ucfirst(explode("controller", strtolower($name))[0]);

                $Model = getDefualt('./src/default/Model');
                $Model = str_replace(['{ModelName}', '{strtolower(ModelName)}'],[ucfirst(explode("controller", strtolower($name))[0]),strtolower(explode("controller", strtolower($name))[0])], $Model);

                $Controller = getDefualt('./src/default/Controller');
                $Controller = str_replace(['{ControllerName}', '{Model}'],[ucfirst($name),$ModelName], $Model);

                file_put_contents('./App/Controllers/' . ucfirst($name) . ".php", $Controller);
                file_put_contents("./App/Models/" . $ModelName . ".php", $Model);
                echo ucfirst($name) . " Controller ochildi.";
            }
        }
    }

?>