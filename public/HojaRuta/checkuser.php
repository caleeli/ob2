<?php
session_start();
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

if (($username === 'mtorrez' && $password === 'm2018') || ($username === 'wvargas' && $password === 'wvargas123') || ($username === 'mvargas' && $password === '1234567')) {
    $_SESSION['hr_user'] = $username;
    $_SESSION['hr_readonly'] = false;
    header('Location: index.php');
} elseif (($username === 'svelasquez' && $password === 'svelasquez123')) {
    $_SESSION['hr_user'] = $username;
    $_SESSION['hr_readonly'] = true;
    header('Location: index.php#busqueda');
} else {
    header('Location: login.php?e');
}
