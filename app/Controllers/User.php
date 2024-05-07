<?php

namespace app\Controllers;

use App\Core\database\Model;

class User {
    static public function getUserName () {
        Model::test();
        echo 'KomiljonovDev';
    }
}