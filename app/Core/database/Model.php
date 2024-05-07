<?php

namespace App\Core\database;

abstract class Model extends Connector{
    protected static $tablename;

    // Ma'lumot bazasi bilan aloqada vujudga kelishi mumkin bo'lgan xatolikdan qochib qutulish
    public function escapeString($value)
    {
        parent::connect();
        return mysqli_real_escape_string(parent::$conn, $value);
    }

    // Ma'lumotlar bazasidan barcha ma'lumotlarni olish
    public static function selectAll()
    {
        parent::connect();
        parent::$sqlQuery = 'SELECT * FROM ' . parent::$DATABASE_NAME . '.' . static::$tablename;
        parent::$dataSet = mysqli_query(parent::$conn, parent::$sqlQuery);
        foreach (parent::$dataSet as $key => $value){
            $arr[] = $value;
        }
        return $arr;
    }

    // Ma'lumotlar bazasidan biror shartga ko'ra ma'lumot olish
    public static function selectWhere($condition, $extra="")
    {
        parent::connect();
        parent::$sqlQuery = 'SELECT * FROM ' . static::$tablename . ' WHERE ';
        if (gettype($condition) == "array") {
            foreach ($condition as $keys => $values) {
                foreach ($values as $key => $value) {
                    if ($key !== 'cn') {
                        parent::$sqlQuery .= parent::escapeString($key) . " " . $values['cn'] . "'";
                        parent::$sqlQuery .= parent::escapeString($values[$key]);
                        parent::$sqlQuery .= "' and ";
                    }
                }
            }
            parent::$sqlQuery = substr(parent::$sqlQuery, 0,strlen(parent::$sqlQuery)-4);
        }else{
            parent::$sqlQuery .= $condition;
        }
        parent::$dataSet = mysqli_query(parent::$conn, parent::$sqlQuery);
        return parent::$dataSet;
    }

    // Ma'lumotlar bazasiga ma'lumot kiritish
    public static function insertInto($data=[])
    {
        parent::connect();
        parent::$sqlQuery = 'INSERT INTO ' . static::$tablename;
        $columns = '(';
        $values = "(";
        foreach ($data as $key => $value) {
            $columns .= parent::escapeString($key) . ',';
            $values .= "'";
            $values .= parent::escapeString($value) . "',";
        }
        $columns = substr($columns, 0, strlen($columns)-1);
        $values = substr($values, 0, strlen($values)-1);
        $columns .= ')';
        $values .= ')';
        parent::$sqlQuery .= $columns . ' VALUES ' . $values;
        return (mysqli_query(parent::$conn, parent::$sqlQuery)) ? true : false;
    }

    // Ma'lumotlar bazasidan biror ma'lumotni shartga ko'ra o'chirish
    public static function deleteWhere($condition=[],$extra="")
    {
        parent::connect();
        parent::$sqlQuery = 'DELETE FROM ' . static::$tablename . ' WHERE ';
        foreach ($condition as $values) {
            foreach ($values as $key => $value) {
                if ($key != 'cn') {
                    parent::$sqlQuery .= parent::escapeString($key) . " " . $values['cn'] . "'";
                    parent::$sqlQuery .= parent::escapeString($values[$key]) . "'";
                    parent::$sqlQuery .= ' and ';
                }
            }
        }
        parent::$sqlQuery = substr(parent::$sqlQuery, 0, strlen(parent::$sqlQuery)-4);
        parent::$sqlQuery .= $extra;
        parent::$dataSet = mysqli_query(parent::$conn, parent::$sqlQuery);
        return (parent::$dataSet) ? true : false;
    }

    // Ma'lumotlar bazisadan biror shartga ko'ra ma'lumotni yangilash
    public static function updateWhere($values=[], $condition=[], $extra="")
    {
        parent::connect();
        parent::$sqlQuery = 'UPDATE ' . static::$tablename . ' SET ';
        foreach ($values as $key => $value) {
            parent::$sqlQuery .= parent::escapeString($key);
            parent::$sqlQuery .= "='";
            parent::$sqlQuery .= parent::escapeString($value);
            parent::$sqlQuery .= "',";
        }
        parent::$sqlQuery = substr(parent::$sqlQuery, 0,strlen(parent::$sqlQuery)-1);
        parent::$sqlQuery .= ' WHERE ';
        foreach ($condition as $keys => $val) {
            if ($keys != 'cn') {
                parent::$sqlQuery .= parent::escapeString($keys) . $condition['cn'] = "='";
                parent::$sqlQuery .= parent::escapeString($condition[$keys]) . "' ";
                parent::$sqlQuery .= " and ";
            }
        }
        parent::$sqlQuery = substr(parent::$sqlQuery, 0, strlen(parent::$sqlQuery)-4);
        parent::$sqlQuery .= $extra;
        return (mysqli_query(parent::$conn, parent::$sqlQuery)) ? true : false;
    }

    // Ma'lumotlar bazasiga qo'lda so'rov yuborish
    public static function withSqlQuery($query)
    {
        parent::connect();
        return parent::$dataSet = mysqli_query(parent::$conn, parent::escapeString($query));
    }

    // Ma'lumotlar bazasiga qo'lda so'rov yuborish
    public static function withSqlQueryWithOutEscapeString($query)
    {
        parent::connect();
        return parent::$dataSet = mysqli_query(parent::$conn, $query);
    }

    // Ma'lumotni tartib bilan o'qib olish
    public static function fetch()
    {
        parent::connect();
        if (parent::$dataSet) {
            return mysqli_fetch_assoc(parent::$dataSet) ?? false;
        }
        return false;
    }
}