<?php
use \App\Core\database\Migration;
class users extends Migration {
    public function up(){
        parent::create('users',[
           'id'=>'INT PRIMARY KEY',
            'created_at'=>'DATETIME',
            'deleted_at'=>'DATETIME'
        ]);
    }
    public function drop(){
        parent::drop('users');
    }
}
?>