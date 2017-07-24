<?php
$host = 'localhost';
$db = 'sistema';
$username = 'root';
$password = 'root';
$connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);

return $connection;