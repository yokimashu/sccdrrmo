<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}


//local
$dbHost = "localhost";
$dbName = "sccdrrmo";
$dbUser = "root";
$dbPasw = "";


//server local port
// $host = "127.0.0.1:3307";
// $db_name = "sccdrrmo";
// $username = "root";
// $password = "5zAhx4Et37Wr";

//server
// $dbHost = "127.0.0.1";
// $dbName = "sccdrrmo";
// $dbUser = "root";
// $dbPasw = "I0nvNUWNXoYI";

try {
	$connect = new PDO("mysql:host={$dbHost};dbname={$dbName}", $dbUser, $dbPasw);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e->getMessage();
}
