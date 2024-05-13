<?php

namespace App\Core\database;

class Migration extends Connector {
    public static function create(string $tablename, array $columns) {
        parent::connect();
        parent::$sqlQuery = "CREATE TABLE IF NOT EXISTS $tablename (";
        foreach ($columns as $column => $type) {
            parent::$sqlQuery .= $column . " " . $type;
        }
        parent::$sqlQuery .= ")";
        parent::$dataSet = mysqli_query(parent::$conn, parent::$sqlQuery);
        return parent::$dataSet;
    }

    public static function dropTable (string $tablename) {
        parent::connect();
        parent::$sqlQuery = "DROP TABLE " . $tablename;
        parent::$dataSet = mysqli_query(parent::$conn, parent::$sqlQuery);
        return parent::$dataSet;
    }

    public static function tabeleExist (string $tableName) {
        parent::connect();
        parent::$sqlQuery = "SHOW TABLES LIKE " . $tableName;
        parent::$dataSet = mysqli_query(parent::$conn, parent::$sqlQuery);
        return parent::rowCount() > 0;
    }
}