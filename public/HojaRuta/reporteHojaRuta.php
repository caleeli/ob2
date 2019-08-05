<?php
/* @var $connection PDO */
$connection = require('connection.php');

$query = [];
$params = [];
$addDerivacion = false;
if ($_REQUEST['tipo']) {
    $query[] = ' hoja_ruta.tipo = :tipo';
    $params['tipo'] = $_REQUEST['tipo'];
}
if (!empty($_REQUEST['fecha_recepcion1'])) {
    $query[] = ' hoja_ruta.fecha >= :fecha_recepcion1';
    $params['fecha_recepcion1'] = $_REQUEST['fecha_recepcion1'];
}
if (!empty($_REQUEST['fecha_recepcion2'])) {
    $query[] = ' hoja_ruta.fecha <= :fecha_recepcion2';
    $params['fecha_recepcion2'] = $_REQUEST['fecha_recepcion2'];
}
if (!empty($_REQUEST['referencia'])) {
    $query[] = ' hoja_ruta.referencia like :referencia';
    $params['referencia'] = '%' . str_replace(' ', '%', $_REQUEST['referencia']) . '%';
}
if (!empty($_REQUEST['procedencia'])) {
    $query[] = ' hoja_ruta.procedencia like :procedencia';
    $params['procedencia'] = '%' . str_replace(' ', '%', $_REQUEST['procedencia']) . '%';
}
if (!empty($_REQUEST['nroDeControl'])) {
    $q = [];
    foreach(explode(',', $_REQUEST['nroDeControl']) as $nro) {
        $q[] = "hoja_ruta.nro_de_control REGEXP '[[:<:]]" . str_replace(['"', ' '], "", $nro) . "[[:>:]]'";
    }
    $query[] = '(' . implode(' or ', $q) . ')';
}
if (!empty($_REQUEST['fecha_conclusion1'])) {
    $query[] = ' hoja_ruta.conclusion >= :fecha_conclusion1';
    $params['fecha_conclusion1'] = $_REQUEST['fecha_conclusion1'];
}
if (!empty($_REQUEST['fecha_conclusion2'])) {
    $query[] = ' hoja_ruta.conclusion <= :fecha_conclusion2';
    $params['fecha_conclusion2'] = $_REQUEST['fecha_conclusion2'];
}
if (!empty($_REQUEST['gestion'])) {
    $q = [];
    foreach(explode(',', $_REQUEST['gestion']) as $gestion) {
        $q[] = "hoja_ruta.gestion = '$gestion'";
    }
    $query[] = '(' . implode(' or ', $q) . ')';
}
if (!empty($_REQUEST['fecha_derivacion1'])) {
    $query[] = ' derivacion.fecha >= :fecha_derivacion1';
    $params['fecha_derivacion1'] = $_REQUEST['fecha_derivacion1'];
    $addDerivacion = true;
}
if (!empty($_REQUEST['fecha_derivacion2'])) {
    $query[] = ' derivacion.fecha <= :fecha_derivacion2';
    $params['fecha_derivacion2'] = $_REQUEST['fecha_derivacion2'];
    $addDerivacion = true;
}
if (!empty($_REQUEST['destinatario'])) {
    $query[] = ' derivacion.destinatario like :destinatario';
    $params['destinatario'] = '%' . str_replace(' ', '%', $_REQUEST['destinatario']) . '%';
    $addDerivacion = true;
}
if (!empty($_REQUEST['tipoTarea'])) {
    $query[] = ' hoja_ruta.tipo_tarea = :tipo_tarea';
    $params['tipo_tarea'] = $_REQUEST['tipoTarea'];
}
$addDerivacion = true;
$select = 'hoja_ruta.*, derivacion.fecha as derivacion_fecha, derivacion.destinatario as derivacion_destinatario, derivacion.instruccion';

if ($_REQUEST['todasLasDerivaciones'] === 'true') {
    $query = 'select ' . $select . ' from hoja_ruta '
        . ($addDerivacion ? 'left join derivacion on (derivacion.hoja_ruta_id=hoja_ruta.id) ' : '')
        . ($query ? 'where hoja_ruta.id in '
        . '(select hoja_ruta.id from hoja_ruta left join derivacion on (derivacion.hoja_ruta_id=hoja_ruta.id) where '
        . implode(' and ', $query) . ')' : '');
} else {
    $esElUltimoDestinatario = 'derivacion.id = (select max(id) from derivacion d2 where d2.hoja_ruta_id=hoja_ruta.id)';
    $query = 'select ' . $select . ' from hoja_ruta '
        . ($addDerivacion ? 'left join derivacion on (derivacion.hoja_ruta_id=hoja_ruta.id and '.$esElUltimoDestinatario.') ' : '')
        . ($query ? ' where ' . implode(' and ', $query) : '');
}

$stmt = $connection->prepare($query);
foreach($params as $p) {
    if (is_array($p)) {
        $stmt->bindParam(":$p", $p, PDO::PA);
    } else {

    }
}
$stmt->execute($params);
$res = [];
$num = 1;
while($row = $stmt->fetch()) {
    $id = $row['id'];
    if (!isset($res[$id])) {
        $res[$id] = $row;
        $res[$id]['derivaciones'] = [];
    }
    $res[$id]['derivaciones'][] = [
        "fecha" => $row['derivacion_fecha'],
        "destinatario" => $row['derivacion_destinatario'],
        "num" => $num,
    ];
    if (!empty($_REQUEST['destinatario'])) {
        $res[$id]['derivacion_destinatario'] = $_REQUEST['destinatario'];
    }
    $num++;
}
echo json_encode(array_values($res));
