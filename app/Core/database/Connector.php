<?php

namespace App\Core\database;

abstract class Connector {

    protected static $HOSTNAME = NULL;
    protected static $DATABASE_USERNAME = NULL;
    protected static $DATABASE_PASSWORD = NULL;
    protected static $DATABASE_NAME = NULL;
    protected static $conn = NULL;
    protected static $sqlQuery = NULL;
    protected static $dataSet = NULL;

    public static function connect () {
        self::$HOSTNAME = env("HOSTNAME");
        self::$DATABASE_USERNAME = env("DATABASE_USERNAME");
        self::$DATABASE_PASSWORD = env("DATABASE_PASSWORD");
        self::$DATABASE_NAME = env("DATABASE_NAME");

        if (!self::$conn) {
            self::$conn = mysqli_connect(
                self::$HOSTNAME,
                self::$DATABASE_USERNAME,
                self::$DATABASE_PASSWORD,
                self::$DATABASE_NAME
            );
        }
        if (!self::$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }
    }

    public static function getConnection() {
        if (!self::$conn) {
            self::connect();
        }
        return self::$conn;
    }
}