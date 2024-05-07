<?php

namespace app\Models;

use App\Core\database\Model;

class User extends Model {
    public function __construct () {
        return parent::connect();
    }

    public static function getConnection () {
        return parent::$connectionString;
    }
}