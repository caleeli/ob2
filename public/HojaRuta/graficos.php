<?php
/* @var $connection PDO */
$connection = require('connection.php');

/**
 * Concluidos
 */
$stmt = $connection->prepare(''
    . 'select date_format(fecha,"%m") as mes, count(*) as conteo from hoja_ruta where '
    . 'date_format(fecha,"%Y")=date_format(now(),"%Y") ' //del año actual
    . 'and conclusion!="0000-00-00"'
    . 'group by date_format(fecha,"%m") order by 1'); //por mes

$stmt->execute([]);
$res =  $stmt->fetchAll();
if ($stmt->errorCode()[0]!=0) {
    print_r($stmt->errorInfo());
}
$concluidos = ["01"=>0, "02"=>0, "03"=>0, "04"=>0, "05"=>0, "06"=>0,"07"=>0,"08"=>0,"09"=>0,"10"=>0,"11"=>0,"12"=>0];
foreach($res as $row) {
    $concluidos[$row['mes']] = $row['conteo']*1;
}
/**
 * Pendientes
 */
$stmt = $connection->prepare($sql=''
    . 'select date_format(fecha,"%m") as mes, count(*) as conteo from hoja_ruta where '
    . 'date_format(fecha,"%Y")=date_format(now(),"%Y") ' //del año actual
    . 'and conclusion="0000-00-00"'
    . 'group by date_format(fecha,"%m") order by 1'); //por mes

$stmt->execute([]);
if ($stmt->errorCode()[0]!=0) {
    print_r($stmt->errorInfo());
}
$res =  $stmt->fetchAll();
$pendientes = ["01"=>0, "02"=>0, "03"=>0, "04"=>0, "05"=>0, "06"=>0,"07"=>0,"08"=>0,"09"=>0,"10"=>0,"11"=>0,"12"=>0];
foreach($res as $row) {
    $pendientes[$row['mes']] = $row['conteo']*1;
}

echo json_encode([
    "meses"=>["Ene", "Feb", "Mar", "Abr", "May", "Jun","Jul","Ago","Sep","Nov","Dic"],
    "concluidos"=>  array_values($concluidos),
    "pendientes"=> array_values($pendientes),
    "totalesMes"=>[$concluidos[Date("m")],$pendientes[Date("m")]],
]);
