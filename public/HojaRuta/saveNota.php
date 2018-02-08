<?php
header("Content-Type: application/json;charset=utf-8");
$connection = require('connection.php');
if (empty($_REQUEST['id'])) {
    $stmt = $connection->prepare('insert into notas_oficio(hoja_de_ruta,
        fecha_emision,
        nro_nota,
        reiterativa,
        fecha_entrega,
        entidad_empresa,
        nombre_apellidos,
        cargo,
        referencia,
        dias,
        retraso,
        hoja_de_ruta_recepcion,
        fecha_recepcion,
        nro_nota_recepcion,
        remitente_recepcion,
        referencia_recepcion,
        fojas_recepcion
        )'
        .' values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');

    $stmt->execute([
        $_REQUEST['hoja_de_ruta'],
        $_REQUEST['fecha_emision'],
        $_REQUEST['nro_nota'],
        $_REQUEST['reiterativa'],
        empty($_REQUEST['fecha_entrega'])?'':$_REQUEST['fecha_entrega'],
        $_REQUEST['entidad_empresa'],
        $_REQUEST['nombre_apellidos'],
        $_REQUEST['cargo'],
        $_REQUEST['referencia'],
        $_REQUEST['dias'],
        $_REQUEST['retraso'],
        $_REQUEST['hoja_de_ruta_recepcion'],
        $_REQUEST['fecha_recepcion'],
        $_REQUEST['nro_nota_recepcion'],
        $_REQUEST['remitente_recepcion'],
        $_REQUEST['referencia_recepcion'],
        $_REQUEST['fojas_recepcion'],
    ]);
} else {
    ini_set("display_errors", "on");
    error_reporting(E_ALL);
    $stmt = $connection->prepare('update notas_oficio set hoja_de_ruta=?, fecha_emision=?, nro_nota=?, reiterativa=?, fecha_entrega=?, entidad_empresa=?, nombre_apellidos=?, cargo=?, referencia=?, dias=?, retraso=?, hoja_de_ruta_recepcion=?, fecha_recepcion=?, nro_nota_recepcion=?, remitente_recepcion=?, referencia_recepcion=?, fojas_recepcion=? '
        .' where id = ?');
    $stmt->execute([
        $_REQUEST['hoja_de_ruta'],
        $_REQUEST['fecha_emision'],
        $_REQUEST['nro_nota'],
        $_REQUEST['reiterativa'],
        empty($_REQUEST['fecha_entrega'])?'':$_REQUEST['fecha_entrega'],
        $_REQUEST['entidad_empresa'],
        $_REQUEST['nombre_apellidos'],
        $_REQUEST['cargo'],
        $_REQUEST['referencia'],
        $_REQUEST['dias'],
        $_REQUEST['retraso'],
        $_REQUEST['hoja_de_ruta_recepcion'],
        $_REQUEST['fecha_recepcion'],
        $_REQUEST['nro_nota_recepcion'],
        $_REQUEST['remitente_recepcion'],
        $_REQUEST['referencia_recepcion'],
        $_REQUEST['fojas_recepcion'],
        $_REQUEST['id'],
    ]);

}
echo '[]';
