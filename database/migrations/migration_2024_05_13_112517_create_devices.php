<?php
use \App\Core\database\Migration;
class Devices extends Migration {
    public function up(){
        parent::create('devices',[
           'id'=>'INT PRIMARY KEY',
            'created_at'=>'DATETIME',
            'deleted_at'=>'DATETIME'
        ]);
    }
    public function drop(){
        parent::drop('devices');
    }
}
?>