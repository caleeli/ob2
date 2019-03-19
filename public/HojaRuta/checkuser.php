<?php
session_start();
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

if (($username === 'mary' && $password === 'm2018') || ($username === 'wvargas' && $password === 'wvargas123')) {
    $_SESSION['hr_user'] = $username;
    header('Location: index.php');
} else {
    header('Location: login.php?e');
}
