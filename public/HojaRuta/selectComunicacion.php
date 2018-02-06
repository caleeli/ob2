<?php
/* @var $connection PDO */
$connection = require('connection.php');
const LIMIT = 50;

if (empty($_REQUEST['filter'])) {
    $stmt = $connection->prepare('select * from comunicaciones_internas order by fecha_entrega desc limit '.LIMIT);
    $stmt->execute();
    $res =  $stmt->fetchAll();

} else {
    $stmt = $connection->prepare('select * from comunicaciones_internas where '
        . 'hoja_de_ruta like :filter or nro_nota like :filter or entidad_empresa like :filter or '
        . 'nombre_apellidos like :filter or cargo like :filter or '
        . 'referencia like :filter or hoja_de_ruta_recepcion like :filter or '
        . 'nro_nota_recepcion like :filter or remitente_recepcion like :filter or '
        . 'referencia_recepcion like :filter or fojas_recepcion like :filter order by fecha_entrega desc limit '.LIMIT);
    $stmt->execute([
        'filter' => '%'.$_REQUEST['filter'].'%'
    ]);
    $res =  $stmt->fetchAll();
}

echo json_encode($res);
