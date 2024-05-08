<?php
use \App\Core\database\Migration;
class tests extends Migration {
    public static function up(){
        parent::create('tests',[
           'id'=>'INT PRIMARY KEY',
            'created_at'=>'DATETIME',
            'deleted_at'=>'DATETIME'
        ]);
    }
    public static function drop(){
        if (parent::tabeleExist('tests')){
            parent::drop('tests');
        }
    }
}


?>