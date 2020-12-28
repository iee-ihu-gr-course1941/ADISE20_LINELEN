<?php

$host='localhost';
$db = 'project_db';

require_once "config_local.php";

$user=$DB_USER;
$pass=$DB_PASS;

global $mysqli;
$mysqli = new mysqli($host, $user, $pass, $db);    
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . 
    $mysqli->connect_errno . ") " . $mysqli->connect_error;
}?>

