<?php
header('Content-Type: application/json; charset=UTF-8');

$mapeo = [];

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    $data = file_get_contents('php://input');
    error_log(__DIR__ . '/syncdata/' . getSheetReference());
    file_put_contents(__DIR__ . '/syncdata/' . getSheetReference() . '.json', $data);
    return;
} else {
    $filename = __DIR__ . '/syncdata/' . getConsolidatedReference() . '.json';
    error_log($filename);
    if (file_exists($filename)) {
        readfile(__DIR__ . '/syncdata/' . getConsolidatedReference() . '.json');
    } else {
        echo '{"fila":1,"columna":1,"datos":[]}';
    }
}

function getSheetReference()
{
    $headers = getallheaders();
    return str_replace('/', '', $headers['trabajo']) . '@' . str_replace('/', '', $headers['hoja']);
}

function getConsolidatedReference()
{
    $headers = getallheaders();
    /* @var $connection PDO */
    $connection = require('connection.php');

    $stmt = $connection->prepare('select origen, origen_hoja'
        . ' from enlaces_excel where destino=:destino and destino_hoja=:destino_hoja');
    $stmt->execute([
        'destino' => $headers['trabajo'],
        'destino_hoja' => $headers['hoja']
    ]);
    $map = $stmt->fetch();
    return $map['origen'] . '@' . $map['origen_hoja'];
}
