<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require 'autoload.php';

use database\migrations\Users;

Users::up();

?>
