<?php

namespace database\migrations;

use \App\Core\database\Migration;
class Users extends Migration {
    static public function up(){
        parent::create('users',[
            'id'=>'INT PRIMARY KEY',
            'username'=>'VARCHAR(255)',
            'password'=>'VARCHAR(255)',
            'created_at'=>'DATETIME',
            'deleted_at'=>'DATETIME'
        ]);
    }
    static public function drop(){
        parent::drop('users');
    }
}
?>