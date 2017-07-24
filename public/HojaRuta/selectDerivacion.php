<?php
/* @var $connection PDO */
$connection = require('connection.php');

if (empty($_REQUEST['filter'])) {
    $stmt = $connection->prepare('select * from derivacion where hoja_ruta_id=? order by fecha asc, id asc limit 15');
    $stmt->execute([
        $_REQUEST['hoja_ruta_id']
    ]);
    $res =  $stmt->fetchAll();

} else {
    $stmt = $connection->prepare('select * from derivacion where '
        . '(fecha like :filter or cometarios like :filter or destinatario like :filter or '
        . 'instruccion like :filter) and (hoja_ruta_id=:hoja_ruta_id) order by fecha asc, id asc limit 15');
    $stmt->execute([
        'hoja_ruta_id' => $_REQUEST['hoja_ruta_id'],
        'filter' => '%'.$_REQUEST['filter'].'%'
    ]);
    $res =  $stmt->fetchAll();
}

echo json_encode($res);
