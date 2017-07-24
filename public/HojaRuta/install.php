<?php

$host = 'localhost';
$db = 'sistema';
$username = 'root';
$password = 'root';
$connection = new PDO("mysql:host=$host", $username, $password);

$connection->exec('CREATE DATABASE IF NOT EXISTS `'.$db.'`');
$connection->exec('USE `'.$db.'`');
$connection->exec('CREATE TABLE IF NOT EXISTS `hoja_ruta` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fecha` date NOT NULL,
  `referencia` char(120) NOT NULL,
  `procedencia` char(80) NOT NULL,
  `nro_de_control` char(15) NOT NULL,
  `anexo_hojas` char(4) NOT NULL,
  `destinatario` char(80) NOT NULL,
  `conclusion` date NOT NULL,
  `tipo` enum("externa", "interna") default "interna"
)');
$connection->exec('CREATE TABLE IF NOT EXISTS `derivacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fecha` date NOT NULL,
  `comentarios` char(220) NOT NULL,
  `destinatario` char(80) NOT NULL,
  `instruccion` char(80) NOT NULL,
  `hoja_ruta_id` int(11) not null
)');

header("Location: index.php");
