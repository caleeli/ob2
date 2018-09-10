<?php
$host = '127.0.0.1';
$db = 'sistema';
$username = 'root';
$password = '';
$connection = new PDO("mysql:dbname=$db;host=$host;charset=utf8", $username, $password );

return $connection;
