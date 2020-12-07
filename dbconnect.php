<?php
require_once "db.php";
$host='localhost';
$user=$DB_USER;
$pass='';
$db = 'dbgame';
global $mysqli;
$mysqli = new mysqli($host, $user, $pass, $db);  
  
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . 
    $mysqli->connect_errno . ") " . $mysqli->connect_error;
}?>