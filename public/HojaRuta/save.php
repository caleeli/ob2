<?php
/* @var $connection PDO */
$connection = require('connection.php');

if (empty($_REQUEST['id'])) {
    $stmt = $connection->prepare('insert into hoja_ruta(tipo, fecha, referencia, procedencia, nro_de_control, anexo_hojas, destinatario, conclusion)'
        .' values (?,?,?,?,?,?,?,?)');

    $stmt->execute([
        $_REQUEST['tipo'],
        empty($_REQUEST['fecha']) ? '0000-00-00': $_REQUEST['fecha'],
        $_REQUEST['referencia'],
        $_REQUEST['procedencia'],
        $_REQUEST['nro_de_control'],
        $_REQUEST['anexo_hojas'],
        $_REQUEST['destinatario'],
        empty($_REQUEST['conclusion']) ? '0000-00-00' : $_REQUEST['conclusion'],
    ]);
    //save derivation
    $stmt = $connection->prepare('insert into derivacion(fecha, comentarios, destinatario, instruccion, hoja_ruta_id)'
        .' values (?,?,?,?,?)');

    $stmt->execute([
        empty($_REQUEST['fecha']) ? '0000-00-00': $_REQUEST['fecha'],
        $_REQUEST['referencia'],
        $_REQUEST['destinatario'],
       '',
        $connection->lastInsertId(),
    ]);
} else {
    $stmt = $connection->prepare('update hoja_ruta set tipo=?, fecha=?, referencia=?, procedencia=?, nro_de_control=?, anexo_hojas=?, destinatario=?, conclusion=? '
        .' where id = ?');

    $stmt->execute([
        $_REQUEST['tipo'],
        empty($_REQUEST['fecha']) ? '0000-00-00': $_REQUEST['fecha'],
        $_REQUEST['referencia'],
        $_REQUEST['procedencia'],
        $_REQUEST['nro_de_control'],
        $_REQUEST['anexo_hojas'],
        $_REQUEST['destinatario'],
        empty($_REQUEST['conclusion']) ? '0000-00-00' : $_REQUEST['conclusion'],
        $_REQUEST['id'],
    ]);
}
echo '[]';
