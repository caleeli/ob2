<?php
/* @var $connection PDO */
$connection = require('connection.php');

if (empty($_REQUEST['filter'])) {
    $stmt = $connection->prepare('select * from hoja_ruta order by fecha desc limit 15');
    $stmt->execute();
    $res =  $stmt->fetchAll();

} else {
    $stmt = $connection->prepare('select * from hoja_ruta where '
        . 'fecha like :filter or referencia like :filter or procedencia like :filter or '
        . 'nro_de_control like :filter or anexo_hojas like :filter or '
        . 'destinatario like :filter or conclusion like :filter order by fecha desc limit 15');
    $stmt->execute([
        'filter' => '%'.$_REQUEST['filter'].'%'
    ]);
    $res =  $stmt->fetchAll();
}

echo json_encode($res);