<?php
/* @var $connection PDO */
header("Content-type:application/json");
$connection = require('connection.php');

$data = json_decode($_REQUEST['data'], true);
$selected = json_decode($_REQUEST['selected']);

foreach($selected as $hojaId) {

    $stmt = $connection->prepare('insert into derivacion(fecha, comentarios, destinatario, destinatarios, instruccion, hoja_ruta_id, dias_plazo)'
    .' values (?,?,?,?,?,?,?)');
    
    $stmt->execute([
        empty($data['fecha']) ? '0000-00-00': $data['fecha'],
        $data['comentarios'],
        $data['destinatario'],
        $data['destinatarios'],
        $data['instruccion'],
        $hojaId,
        $data['dias_plazo'],
    ]);
}

echo '{"success":true}';
