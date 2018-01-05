<?php
/**
 * CREATE TABLE `reserva_numero` (
 *   `tipo` char(32) NOT NULL,
 *   `gestion` int NOT NULL,
 *   `numero` int NOT NULL
 * );
 */
/* @var $connection PDO */
$connection = require('connection.php');
/*$stmt = $connection->prepare('insert into reserva_numero (tipo,gestion,numero,due) '
    . 'values (?,?,(select ifnull(max(numero),0) + 1 from reserva_numero where '
    . 'tipo=? and gestion=?), now()+1)');
$stmt->execute([
    $tipo,
    $gestion,

]);*/
$gestion = date('Y');
$stmt = $connection->prepare('select ifnull(max(numero),0) + 1 as reservedNumber from hoja_ruta where '
    . 'gestion=?');
$stmt->execute([
    $gestion
]);
$res = $stmt->fetch();

echo json_encode($res);
