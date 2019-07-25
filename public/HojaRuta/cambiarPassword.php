<?php
session_start();

/* @var $connection PDO */
header('Content-type:application/json');
$connection = require 'connection.php';

if ($_SESSION['hr_user'] && $_POST['password']) {
    $stmt = $connection->prepare('update usuarios set password=:password where nombre=:nombre');
    $stmt->execute([
        'nombre' => $_SESSION['hr_user'],
        'password' => md5($_POST['password']),
    ]);
    echo '{"success":true}';
    return;
}
