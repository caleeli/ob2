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
$connection->exec("CREATE TABLE `notas` (
  	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	hoja_de_ruta varchar(80) COLLATE 'utf8_general_ci' NULL,
	fecha_emision varchar(80) COLLATE 'utf8_general_ci' NULL,
	nro_nota varchar(80) COLLATE 'utf8_general_ci' NULL,
	reiterativa varchar(80) COLLATE 'utf8_general_ci' NULL,
	fecha_entrega varchar(80) COLLATE 'utf8_general_ci' NULL,
	entidad_empresa varchar(200) COLLATE 'utf8_general_ci' NULL,
	nombre_apellidos varchar(200) COLLATE 'utf8_general_ci' NULL,
	cargo varchar(100) COLLATE 'utf8_general_ci' NULL,
	referencia mediumtext COLLATE 'utf8_general_ci' NULL,
	dias varchar(80) COLLATE 'utf8_general_ci' NULL,
	retraso varchar(80) COLLATE 'utf8_general_ci' NULL,
	hoja_de_ruta_recepcion varchar(80) COLLATE 'utf8_general_ci' NULL,
	fecha_recepcion varchar(80) COLLATE 'utf8_general_ci' NULL,
	nro_nota_recepcion varchar(80) COLLATE 'utf8_general_ci' NULL,
	remitente_recepcion varchar(200) COLLATE 'utf8_general_ci' NULL,
	referencia_recepcion mediumtext COLLATE 'utf8_general_ci' NULL,
	fojas_recepcion varchar(80) COLLATE 'utf8_general_ci' NULL
);");

header("Location: index.php");
