<?php
/* @var $connection PDO */
$connection = require('connection.php');
$tipo = empty($_REQUEST['tipo']) ? '%' : $_REQUEST['tipo'];

$esElUltimoDestinatario = 'derivacion.id = (select max(id) from derivacion d2 where d2.hoja_ruta_id=hoja_ruta.id)';
if (empty($_REQUEST['filter'])) {
    $stmt = $connection->prepare('select hoja_ruta.*, derivacion.destinatario as derivacion_destinatario from hoja_ruta '
        . 'left join derivacion on (derivacion.hoja_ruta_id=hoja_ruta.id and '.$esElUltimoDestinatario.') '
        . 'where tipo like "' . $tipo . '" order by id desc limit 50');
    $stmt->execute();
    $res =  $stmt->fetchAll();

} else {
    $stmt = $connection->prepare('select hoja_ruta.*, derivacion.destinatario as derivacion_destinatario from hoja_ruta '
        . 'left join derivacion on (derivacion.hoja_ruta_id=hoja_ruta.id and '.$esElUltimoDestinatario.') '
        . 'where (hoja_ruta.fecha like :filter or hoja_ruta.referencia like :filter or hoja_ruta.procedencia like :filter or '
        . 'hoja_ruta.nro_de_control like :filter or hoja_ruta.anexo_hojas like :filter or '
        . 'derivacion.destinatario like :filter or hoja_ruta.conclusion like :filter or hoja_ruta.numero like :exacto) and hoja_ruta.tipo like "'
        . $tipo . '" order by id desc limit 50');
    $stmt->execute([
        'filter' => '%'.$_REQUEST['filter'].'%',
        'exacto' => $_REQUEST['filter'],
    ]);
    $res =  $stmt->fetchAll();
}

echo json_encode($res);
