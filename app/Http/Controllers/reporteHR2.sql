SELECT
    derivacion.destinatario as usuario_actual,
    concat(hoja_ruta.nro_de_control,' / ',hoja_ruta.gestion,' ', hoja_ruta.referencia) as titulo,
    hoja_ruta.nro_de_control,
    hoja_ruta.gestion,
    hoja_ruta.nro_de_control,
    hoja_ruta.tipo,
    hoja_ruta.tipo_tarea,
    hoja_ruta.referencia,
    hoja_ruta.procedencia,
    hoja_ruta.id as hr_scep_id,
    if (hoja_ruta.conclusion!='0000-00-00', 'ARCHIVO', derivacion.destinatario) as usuario_actual,

    if(if(derivacion.destinatario='ARCHIVO' and hoja_ruta.conclusion='0000-00-00', derivacion.fecha, hoja_ruta.conclusion)='0000-00-00', 'pendiente', datediff(if(derivacion.destinatario='ARCHIVO' and hoja_ruta.conclusion='0000-00-00', derivacion.fecha, hoja_ruta.conclusion), hoja_ruta.fecha)) as tiempo_conclusion,

    if(hoja_ruta.fecha='0000-00-00', '', hoja_ruta.fecha) as fecha_registro,
    if(hoja_ruta.fecha='0000-00-00', '', monthname(hoja_ruta.fecha)) as mes_registro,
    if(hoja_ruta.fecha='0000-00-00', '', year(hoja_ruta.fecha)) as año_registro,

    if(if(derivacion.destinatario='ARCHIVO' and hoja_ruta.conclusion='0000-00-00', derivacion.fecha, hoja_ruta.conclusion)='0000-00-00', '', if(derivacion.destinatario='ARCHIVO' and hoja_ruta.conclusion='0000-00-00', derivacion.fecha, hoja_ruta.conclusion)) as fecha_conclusion,
    if(if(derivacion.destinatario='ARCHIVO' and hoja_ruta.conclusion='0000-00-00', derivacion.fecha, hoja_ruta.conclusion)='0000-00-00', '', monthname(if(derivacion.destinatario='ARCHIVO' and hoja_ruta.conclusion='0000-00-00', derivacion.fecha, hoja_ruta.conclusion))) as mes_conclusion,
    if(if(derivacion.destinatario='ARCHIVO' and hoja_ruta.conclusion='0000-00-00', derivacion.fecha, hoja_ruta.conclusion)='0000-00-00', '', year(if(derivacion.destinatario='ARCHIVO' and hoja_ruta.conclusion='0000-00-00', derivacion.fecha, hoja_ruta.conclusion))) as año_conclusion,

--    if(asignacion.fecha='0000-00-00', '', asignacion.fecha) as fecha_asignacion,
--    if(asignacion.fecha='0000-00-00', '', monthname(asignacion.fecha)) as mes_asignacion,
--    if(asignacion.fecha='0000-00-00', '', year(asignacion.fecha)) as año_asignacion,

    if(derivacion.fecha='0000-00-00', '', derivacion.fecha) as fecha_asignacion,
    if(derivacion.fecha='0000-00-00', '', monthname(derivacion.fecha)) as mes_asignacion,
    if(derivacion.fecha='0000-00-00', '', year(derivacion.fecha)) as año_asignacion,

    if (if(derivacion.destinatario='ARCHIVO' and hoja_ruta.conclusion='0000-00-00', derivacion.fecha, hoja_ruta.conclusion)!='0000-00-00', 'concluido', 'pendiente') as estado,
    if (if(derivacion.destinatario='ARCHIVO' and hoja_ruta.conclusion='0000-00-00', derivacion.fecha, hoja_ruta.conclusion)!='0000-00-00', '1', '') as concluidos,
    if (if(derivacion.destinatario='ARCHIVO' and hoja_ruta.conclusion='0000-00-00', derivacion.fecha, hoja_ruta.conclusion)!='0000-00-00', '', '1') as pendientes

FROM
   (select hoja_ruta_id, max(id) as id from derivacion group by hoja_ruta_id) ultimos
   inner join hoja_ruta on (ultimos.hoja_ruta_id=hoja_ruta.id)
   inner join derivacion on (ultimos.id=derivacion.id)
--   inner join derivacion as asignacion on (asignacion.id=(select max(id) from derivacion d2 where d2.hoja_ruta_id=hoja_ruta.id and d2.destinatario like '%Edgar%Andrade%'))

