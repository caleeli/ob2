<?php
$env = file_get_contents(__DIR__ . '/../../.env');
$host = preg_match('/HR_DB_HOST=(.*)/', $env, $match) ? $match[1] : '';
$db = preg_match('/HR_DB_DATABASE=(.*)/', $env, $match) ? $match[1] : '';
$username = preg_match('/HR_DB_USERNAME=(.*)/', $env, $match) ? $match[1] : '';
$password = preg_match('/HR_DB_PASSWORD=(.*)/', $env, $match) ? $match[1] : '';
$connection = new PDO("mysql:dbname=$db;host=$host;charset=utf8", $username, $password);

return $connection;
