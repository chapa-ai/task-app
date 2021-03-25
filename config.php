<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root1');
define('DB_PASSWORD', '123');
define('DB_NAME', '2021');


$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
