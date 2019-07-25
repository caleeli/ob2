<?php
session_start();
$connection = require('connection.php');

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

// Carga $usuario de la base de datos
$stmt = $connection->prepare('select * from usuarios where nombre=:nombre and password=:password limit 1');
$stmt->execute([
    'nombre' => $username,
    'password' => md5($password),
]);
$usuario =  $stmt->fetch();

if ($usuario) {
    $_SESSION['hr_user'] = $username;
    $_SESSION['hr_readonly'] = $usuario['invitado'] ? true : false;
    header($_SESSION['hr_readonly'] ? 'Location: index.php#busqueda' : 'Location: index.php');
} else {
    header('Location: login.php?e');
}
