<?php
    namespace Controllers;
    class UserController{
        public static function func1 () {
            return view('welcome',[
                'name'=>'Obidjon',
                'lastname'=>'Komiljonov'
            ]);
        }
        public static function func2 () {
            echo "test-2";
            return true;
        }
    }


    function view (string $view, array $arr = []) {
        extract($arr);
        include '../views/' . $view . '.php';
    }
?>