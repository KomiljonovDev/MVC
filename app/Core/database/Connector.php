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

    // Ma'lumot bazasi bilan aloqada vujudga kelishi mumkin bo'lgan xatolikdan qochib qutulish
    public static function escapeString($value)
    {
        self::connect();
        return mysqli_real_escape_string(self::$conn, $value);
    }

    // Ma'lumotlar bazasidan barcha ma'lumotlarni olish
    public static function selectAll()
    {
        self::connect();
        self::$sqlQuery = 'SELECT * FROM ' . self::$DATABASE_NAME . '.' . static::$tablename;
        self::$dataSet = mysqli_query(self::$conn, self::$sqlQuery);
        foreach (self::$dataSet as $key => $value){
            $arr[] = $value;
        }
        return $arr;
    }

    // Ma'lumotlar bazasidan biror shartga ko'ra ma'lumot olish
    public static function selectWhere($condition, $extra="")
    {
        self::connect();
        self::$sqlQuery = 'SELECT * FROM ' . static::$tablename . ' WHERE ';
        if (gettype($condition) == "array") {
            foreach ($condition as $keys => $values) {
                foreach ($values as $key => $value) {
                    if ($key !== 'cn') {
                        self::$sqlQuery .= self::escapeString($key) . " " . $values['cn'] . "'";
                        self::$sqlQuery .= self::escapeString($values[$key] ?? '');
                        self::$sqlQuery .= "' and ";
                    }
                }
            }
            self::$sqlQuery = substr(self::$sqlQuery, 0,strlen(self::$sqlQuery)-4);
        }else{
            self::$sqlQuery .= $condition;
        }
        self::$dataSet = mysqli_query(self::$conn, self::$sqlQuery);
        return self::$dataSet;
    }

    // Ma'lumotlar bazasiga ma'lumot kiritish
    public static function insertInto($data=[])
    {
        self::connect();
        self::$sqlQuery = 'INSERT INTO ' . static::$tablename;
        $columns = '(';
        $values = "(";
        foreach ($data as $key => $value) {
            $columns .= self::escapeString($key) . ',';
            $values .= "'";
            $values .= self::escapeString($value) . "',";
        }
        $columns = substr($columns, 0, strlen($columns)-1);
        $values = substr($values, 0, strlen($values)-1);
        $columns .= ')';
        $values .= ')';
        self::$sqlQuery .= $columns . ' VALUES ' . $values;
        return (mysqli_query(self::$conn, self::$sqlQuery)) ? true : false;
    }

    // Ma'lumotlar bazasidan biror ma'lumotni shartga ko'ra o'chirish
    public static function deleteWhere($condition=[],$extra="")
    {
        self::connect();
        self::$sqlQuery = 'DELETE FROM ' . static::$tablename . ' WHERE ';
        foreach ($condition as $values) {
            foreach ($values as $key => $value) {
                if ($key != 'cn') {
                    self::$sqlQuery .= self::escapeString($key) . " " . $values['cn'] . "'";
                    self::$sqlQuery .= self::escapeString($values[$key] ?? '') . "'";
                    self::$sqlQuery .= ' and ';
                }
            }
        }
        self::$sqlQuery = substr(self::$sqlQuery, 0, strlen(self::$sqlQuery)-4);
        self::$sqlQuery .= $extra;
        self::$dataSet = mysqli_query(self::$conn, self::$sqlQuery);
        return (self::$dataSet) ? true : false;
    }

    // Ma'lumotlar bazisadan biror shartga ko'ra ma'lumotni yangilash
    public static function updateWhere($values=[], $condition=[], $extra="")
    {
        self::connect();
        self::$sqlQuery = 'UPDATE ' . static::$tablename . ' SET ';
        foreach ($values as $key => $value) {
            self::$sqlQuery .= self::escapeString($key);
            self::$sqlQuery .= "='";
            self::$sqlQuery .= self::escapeString($value);
            self::$sqlQuery .= "',";
        }
        self::$sqlQuery = substr(self::$sqlQuery, 0,strlen(self::$sqlQuery)-1);
        self::$sqlQuery .= ' WHERE ';
        foreach ($condition as $keys => $val) {
            if ($keys != 'cn') {
                self::$sqlQuery .= self::escapeString($keys) . $condition['cn'] = "='";
                self::$sqlQuery .= self::escapeString($condition[$keys]) . "' ";
                self::$sqlQuery .= " and ";
            }
        }
        self::$sqlQuery = substr(self::$sqlQuery, 0, strlen(self::$sqlQuery)-4);
        self::$sqlQuery .= $extra;
        return (mysqli_query(self::$conn, self::$sqlQuery)) ? true : false;
    }

    // Ma'lumotlar bazasiga qo'lda so'rov yuborish
    public static function withSqlQuery($query)
    {
        self::connect();
        return self::$dataSet = mysqli_query(self::$conn, self::escapeString($query));
    }

    // Ma'lumotlar bazasiga qo'lda so'rov yuborish
    public static function withSqlQueryWithOutEscapeString($query)
    {
        self::connect();
        return self::$dataSet = mysqli_query(self::$conn, $query);
    }

    // Ma'lumotni tartib bilan o'qib olish
    public static function fetch()
    {
        self::connect();
        if (self::$dataSet) {
            return mysqli_fetch_assoc(self::$dataSet) ?? false;
        }
        return false;
    }

    public static function rowCount () {
        self::connect();
        if (self::$dataSet) {
            return mysqli_num_rows(self::$dataSet);
        }
        return false;
    }
}