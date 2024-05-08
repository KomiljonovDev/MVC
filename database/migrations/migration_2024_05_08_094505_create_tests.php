<?php
use \App\Core\database\Migration;
class tests extends Migration {
    public function up(){
        parent::create('tests',[
           'id'=>'INT PRIMARY KEY',
            'created_at'=>'DATETIME',
            'deleted_at'=>'DATETIME'
        ]);
    }
    public function drop(){
        parent::drop('tests');
    }
}
?>