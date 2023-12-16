<?php

namespace App\Core\database;

abstract class Connector {
    protected static $HOSTNAME = NULL;
    protected static $USERNAME = NULL;
    protected static $PASSWORD = NULL;
    protected static $DATABASE_NAME = NULL;

    protected static $connectionString = NULL;
    public function __construct () {
        return self::connect();
    }
    public static function connect () {
        self::$HOSTNAME = env("HOSTNAME");
        self::$DATABASE_NAME = env('DATABASE_NAME');
        self::$USERNAME = env('DATABASE_USERNAME');
        self::$PASSWORD = env('DATABASE_PASSWORD');
        self::$connectionString = mysqli_connect(self::$HOSTNAME, self::$USERNAME, self::$PASSWORD, self::$DATABASE_NAME);
        return self::$connectionString;
    }
}