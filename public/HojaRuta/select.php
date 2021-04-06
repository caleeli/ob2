<?php
/* @var $connection PDO */
$connection = require('connection.php');
$tipo = empty($_REQUEST['tipo']) ? '%' : $_REQUEST['tipo'];
$per_page = empty($_REQUEST['per_page']) ? '10' : $_REQUEST['per_page'];
$page = empty($_REQUEST['page']) ? '1' : $_REQUEST['page'];
$offset = ($page - 1) * $per_page;

$esElUltimoDestinatario = 'derivacion.id = (select max(id) from derivacion d2 where d2.hoja_ruta_id=hoja_ruta.id)';
if (empty($_REQUEST['filter'])) {
    $stmt = $connection->prepare('select hoja_ruta.*, derivacion.destinatario as derivacion_destinatario from hoja_ruta '
        . 'left join derivacion on (derivacion.hoja_ruta_id=hoja_ruta.id and '.$esElUltimoDestinatario.') '
        . 'where tipo like "' . $tipo . '" order by id desc limit :per_page offset :offset');
    $stmt->execute([
        'per_page' => $per_page,
        'offset' => $offset,
    ]);
    $res =  $stmt->fetchAll();

} else {
    $stmt = $connection->prepare('select hoja_ruta.*, derivacion.destinatario as derivacion_destinatario from hoja_ruta '
        . 'left join derivacion on (derivacion.hoja_ruta_id=hoja_ruta.id and '.$esElUltimoDestinatario.') '
        . 'where (hoja_ruta.fecha like :filter or hoja_ruta.referencia like :filter or hoja_ruta.procedencia like :filter or '
        . 'hoja_ruta.nro_de_control like :filter or hoja_ruta.anexo_hojas like :filter or '
        . 'derivacion.destinatario like :filter or hoja_ruta.conclusion like :filter or hoja_ruta.numero like :exacto) and hoja_ruta.tipo like "'
        . $tipo . '" order by id desc limit :per_page offset :offset');
    $stmt->execute([
        'filter' => '%'.$_REQUEST['filter'].'%',
        'exacto' => $_REQUEST['filter'],
        'per_page' => $per_page,
        'offset' => $offset,
    ]);
    $res =  $stmt->fetchAll();
}

echo json_encode($res);
