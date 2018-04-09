<?php
$connection = require('connection.php');

if (empty($_REQUEST['id'])) {
    $stmt = $connection->prepare('insert into derivacion(fecha, comentarios, destinatario, destinatarios, instruccion, hoja_ruta_id)'
        .' values (?,?,?,?,?,?)');

    $stmt->execute([
        empty($_REQUEST['fecha']) ? '0000-00-00': $_REQUEST['fecha'],
        $_REQUEST['comentarios'],
        $_REQUEST['destinatario'],
        $_REQUEST['destinatarios'],
        $_REQUEST['instruccion'],
        $_REQUEST['hoja_ruta_id'],
    ]);
} else {
    $stmt = $connection->prepare('update derivacion set fecha=?, comentarios=?, destinatario=?, destinatarios=?, instruccion=?, hoja_ruta_id=? '
        .' where id = ?');

    $stmt->execute([
        empty($_REQUEST['fecha']) ? '0000-00-00': $_REQUEST['fecha'],
        $_REQUEST['comentarios'],
        $_REQUEST['destinatario'],
        $_REQUEST['destinatarios'],
        $_REQUEST['instruccion'],
        $_REQUEST['hoja_ruta_id'],
        $_REQUEST['id'],
    ]);
}
echo '[]';
