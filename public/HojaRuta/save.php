<?php
/* @var $connection PDO */
header("Content-type:application/json");
$connection = require('connection.php');

if (empty($_REQUEST['id'])) {
    $stmt = $connection->prepare('insert into hoja_ruta(tipo, fecha, referencia, procedencia, nro_de_control, anexo_hojas, destinatario, conclusion, numero, tipo_tarea)'
        .' values (?,?,?,?,?,?,?,?,?,?)');

    $guardo = $stmt->execute([
        $_REQUEST['tipo'],
        empty($_REQUEST['fecha']) ? '0000-00-00': $_REQUEST['fecha'],
        $_REQUEST['referencia'],
        $_REQUEST['procedencia'],
        $_REQUEST['nro_de_control'],
        $_REQUEST['anexo_hojas'],
        $_REQUEST['destinatario'],
        empty($_REQUEST['conclusion']) ? '0000-00-00' : $_REQUEST['conclusion'],
        $_REQUEST['numero'],
        $_REQUEST['tipo_tarea'],
    ]);
} else {
    $stmt = $connection->prepare('update hoja_ruta set tipo=?, fecha=?, referencia=?, procedencia=?, nro_de_control=?, anexo_hojas=?, destinatario=?, conclusion=?, tipo_tarea=? '
        .' where id = ?');

    $guardo = $stmt->execute([
        $_REQUEST['tipo'],
        empty($_REQUEST['fecha']) ? '0000-00-00': $_REQUEST['fecha'],
        $_REQUEST['referencia'],
        $_REQUEST['procedencia'],
        $_REQUEST['nro_de_control'],
        $_REQUEST['anexo_hojas'],
        $_REQUEST['destinatario'],
        empty($_REQUEST['conclusion']) ? '0000-00-00' : $_REQUEST['conclusion'],
        $_REQUEST['tipo_tarea'],
        $_REQUEST['id'],
    ]);
}
if (!$guardo) {
    echo '{"error": "No se pudo guardar el registro, por favor revise los datos introducidos"}';
} else {
    echo '{"success": true}';
}
