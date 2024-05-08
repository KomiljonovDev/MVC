<?php

namespace app\Core\Model;

use App\Core\database\Connector;

abstract class Model extends Connector{
    protected static $tablename;

}