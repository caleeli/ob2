<?php
/* @var $connection PDO */
$connection = require('connection.php');
if (!isset($_REQUEST['numero'])) {
    $res = [
        'success' => false,
        'error'   => 'Ingrese un numero',
    ];
    echo json_encode($res);
    return;
}
if (!isset($_REQUEST['gestion'])) {
    $res = [
        'success' => false,
        'error'   => 'Ingrese una gestión',
    ];
    echo json_encode($res);
    return;
}
$numero = $_REQUEST['numero'];
$gestion = $_REQUEST['gestion'];

$stmt = $connection->prepare('select nro_de_control from hoja_ruta where '
    . 'nro_de_control = ? and gestion = ?');
$stmt->execute([
    $numero,
    $gestion
]);

$row = $stmt->fetch();
$success = !empty($row);
$res = [
    'success' => $success,
    'message' => $success ? '<i class="fa fa-check"></i>' : 'El número de control de la hoja de ruta ya fue registrado.',
];
echo json_encode($res);
