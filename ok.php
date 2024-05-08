<?php

    include './app/Core/Helpers/helper.php';

    $command = strtolower($argv[1]);

    if (!$command) {
        die("Quyidagi buyruqlardan biridan foydalaning:\n\nmake:config - making config\nmake:controller {name} - making controller\nmake:model {name} - making model\nmake:migration {name}\nmigrate:up - up migrate\nmigrate:down - down migrate\nserve - serve application\nserve {port} - serve application with custom port");
    }
    if ($command == "configuration") {
        echo "Konfiguratsiya boshlanmoqda...";
        if (!file_exists("./App/Controllers/")) mkdir("./App/Controllers/");
        if (!file_exists("./App/Models/")) mkdir("./App/Models");
        if (!file_exists("./resources/Views")) mkdir("./resources/Views");
        if (!file_exists("./database/migrations")) mkdir("./database/migrations");

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

                $Controller = getDefualt('./src/default/Controller');
                $Controller = str_replace(['{ControllerName}', '{Model}'],[ucfirst($name),$ModelName], $Model);

                file_put_contents('./App/Controllers/' . ucfirst($name) . ".php", $Controller);
                echo ucfirst($name) . " Controller ochildi.";
            }elseif ($parametr == 'model'){
                if (file_exists('./App/Models/' . ucfirst($name) . ".php")) die(ucfirst($name) . " Model avvaldan mavjud.");

                $ModelName = ucfirst(explode("controller", strtolower($name))[0]);
                $Model = getDefualt('./src/default/Model');
                $Model = str_replace(['{ModelName}', '{strtolower(ModelName)}'],[ucfirst(explode("controller", strtolower($name))[0]),strtolower(explode("controller", strtolower($name))[0])], $Model);

                file_put_contents("./App/Models/" . $ModelName . ".php", $Model);
                echo ucfirst($name) . " Model ochildi.";

            }elseif ($parametr == 'migration'){
                $name = strtolower($name) . 's';
                $filename = 'migration_' . date('Y_m_d_His') . '_create_' . $name . ".php";
                $Migration = getDefualt('./src/default/Migration');
                $Migration = str_replace('{migrationName}',strtolower($name), $Migration);

                file_put_contents("./database/migrations/" . $filename, $Migration);
                echo ucfirst($filename) . " Migration ochildi ochildi.";
            }elseif ($parametr == 'migrate'){

            }
        }
    }

?>