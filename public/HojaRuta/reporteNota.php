<?php
/* @var $connection PDO */
$connection = require('connection.php');
const LIMIT = 50;

$query = [];
$params = [];
if (!empty($_REQUEST['hoja_de_ruta'])) {
    $q = [];
    foreach (explode(',', $_REQUEST['hoja_de_ruta']) as $nro) {
        $q[] = "hoja_de_ruta REGEXP '[[:<:]]" . str_replace(['"', ' '], "", trim($nro)) . "[[:>:]]'";
    }
    $query[] = '(' . implode(' or ', $q) . ')';
}
if (!empty($_REQUEST['fecha_emision1'])) {
	$query[] = 'fecha_emision1 >= :fecha_emision1';
	$params['fecha_emision1'] = $_REQUEST['fecha_emision1'];
}
if (!empty($_REQUEST['fecha_emision2'])) {
	$query[] = 'fecha_emision2 <= :fecha_emision2';
	$params['fecha_emision2'] = $_REQUEST['fecha_emision2'];
}
if (!empty($_REQUEST['nro_nota'])) {
    $q = [];
    foreach (explode(',', $_REQUEST['nro_nota']) as $nro) {
        $q[] = "nro_nota REGEXP '[[:<:]]" . str_replace(['"', ' '], "", trim($nro)) . "[[:>:]]'";
    }
    $query[] = '(' . implode(' or ', $q) . ')';
}
if (!empty($_REQUEST['reiterativa'])) {
	$query[] = 'reiterativa = :reiterativa';
	$params['reiterativa'] = $_REQUEST['reiterativa'];
}
if (!empty($_REQUEST['fecha_entrega1'])) {
	$query[] = 'fecha_entrega1 >= :fecha_entrega1';
	$params['fecha_entrega1'] = $_REQUEST['fecha_entrega1'];
}
if (!empty($_REQUEST['fecha_entrega2'])) {
	$query[] = 'fecha_entrega2 <= :fecha_entrega2';
	$params['fecha_entrega2'] = $_REQUEST['fecha_entrega2'];
}
if (!empty($_REQUEST['entidad_empresa'])) {
	$query[] = 'entidad_empresa like :entidad_empresa';
	$params['entidad_empresa'] = '%' . $_REQUEST['entidad_empresa'] . '%';
}
if (!empty($_REQUEST['nombre_apellidos'])) {
	$query[] = 'nombre_apellidos like :nombre_apellidos';
	$params['nombre_apellidos'] = '%'.$_REQUEST['nombre_apellidos'].'%';
}
if (!empty($_REQUEST['cargo'])) {
	$query[] = 'cargo like :cargo';
	$params['cargo'] = '%'.$_REQUEST['cargo'].'%';
}
if (!empty($_REQUEST['referencia'])) {
	$query[] = 'referencia = :referencia';
	$params['referencia'] = '%'.$_REQUEST['referencia'].'%';
}
if (!empty($_REQUEST['hoja_de_ruta_recepcion'])) {
	$query[] = 'hoja_de_ruta_recepcion like :hoja_de_ruta_recepcion';
	$params['hoja_de_ruta_recepcion'] = '%' . $_REQUEST['hoja_de_ruta_recepcion'] . '%';
}
if (!empty($_REQUEST['fecha_recepcion1'])) {
	$query[] = 'fecha_recepcion1 >= :fecha_recepcion1';
	$params['fecha_recepcion1'] = $_REQUEST['fecha_recepcion1'];
}
if (!empty($_REQUEST['fecha_recepcion2'])) {
	$query[] = 'fecha_recepcion2 <= :fecha_recepcion2';
	$params['fecha_recepcion2'] = $_REQUEST['fecha_recepcion2'];
}
if (!empty($_REQUEST['nro_nota_recepcion'])) {
	$query[] = 'nro_nota_recepcion like :nro_nota_recepcion';
	$params['nro_nota_recepcion'] = '%' . $_REQUEST['nro_nota_recepcion'] . '%';
}
if (!empty($_REQUEST['remitente_recepcion'])) {
	$query[] = 'remitente_recepcion like :remitente_recepcion';
	$params['remitente_recepcion'] = '%'.$_REQUEST['remitente_recepcion'].'%';
}
if (!empty($_REQUEST['referencia_recepcion'])) {
	$query[] = 'referencia_recepcion like :referencia_recepcion';
	$params['referencia_recepcion'] = '%'. $_REQUEST['referencia_recepcion'] . '%';
}

$select = '*';

$query = 'select ' . $select . ' from notas_oficio '
    . ($query ? ' where ' . implode(' and ', $query) : '');

$stmt = $connection->prepare($query);
$stmt->execute($params);
$res = $stmt->fetchAll();

echo json_encode($res);
