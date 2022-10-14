<table class="report" v-if="reporte_estado!==null">
    <thead>
        <tr>
            <th></th>
            <th colspan="2">Estado</th>
            <th colspan="3">Prioridad</th>
        </tr>
        <tr>
            <th>Carpeta</th>
            <th>Pendiente</th>
            <th>Completado</th>
            <th>Baja</th>
            <th>Media</th>
            <th>Altas</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Crédito Individual</th>
            <td>{{ reporte_estado.EDC.pendiente || 0}}</td>
            <td>{{ reporte_estado.EDC.completado || 0}}</td>
            <td>{{ reporte_estado.EDC.baja || 0}}</td>
            <td>{{ reporte_estado.EDC.media || 0}}</td>
            <td>{{ reporte_estado.EDC.alta || 0}}</td>
        </tr>
        <tr>
            <th>Crédito Veloz</th>
            <td>{{ reporte_estado.AUD.pendiente || 0}}</td>
            <td>{{ reporte_estado.AUD.completado || 0}}</td>
            <td>{{ reporte_estado.AUD.baja || 0}}</td>
            <td>{{ reporte_estado.AUD.media || 0}}</td>
            <td>{{ reporte_estado.AUD.alta || 0}}</td>
        </tr>
        <tr>
            <th>Crédito Temporada</th>
            <td>{{ reporte_estado.SUP.pendiente || 0}}</td>
            <td>{{ reporte_estado.SUP.completado || 0}}</td>
            <td>{{ reporte_estado.SUP.baja || 0}}</td>
            <td>{{ reporte_estado.SUP.media || 0}}</td>
            <td>{{ reporte_estado.SUP.alta || 0}}</td>
        </tr>
        <tr>
            <th>Crédito Verde</th>
            <td>{{ reporte_estado.RDI.pendiente || 0}}</td>
            <td>{{ reporte_estado.RDI.completado || 0}}</td>
            <td>{{ reporte_estado.RDI.baja || 0}}</td>
            <td>{{ reporte_estado.RDI.media || 0}}</td>
            <td>{{ reporte_estado.RDI.alta || 0}}</td>
        </tr>
        <tr>
            <th>Crediestudio</th>
            <td>{{ reporte_estado.COD.pendiente || 0}}</td>
            <td>{{ reporte_estado.COD.completado || 0}}</td>
            <td>{{ reporte_estado.COD.baja || 0}}</td>
            <td>{{ reporte_estado.COD.media || 0}}</td>
            <td>{{ reporte_estado.COD.alta || 0}}</td>
        </tr>
        <tr>
            <th>Crédito Agropecuario</th>
            <td>{{ reporte_estado.EIU.pendiente || 0}}</td>
            <td>{{ reporte_estado.EIU.completado || 0}}</td>
            <td>{{ reporte_estado.EIU.baja || 0}}</td>
            <td>{{ reporte_estado.EIU.media || 0}}</td>
            <td>{{ reporte_estado.EIU.alta || 0}}</td>
        </tr>
        <tr>
            <th>Crédito Solidario</th>
            <td>{{ reporte_estado.EIP.pendiente || 0}}</td>
            <td>{{ reporte_estado.EIP.completado || 0}}</td>
            <td>{{ reporte_estado.EIP.baja || 0}}</td>
            <td>{{ reporte_estado.EIP.media || 0}}</td>
            <td>{{ reporte_estado.EIP.alta || 0}}</td>
        </tr>
        <tr>
            <th>Bancos de Emprendimiento</th>
            <td>{{ reporte_estado.SYD.pendiente || 0}}</td>
            <td>{{ reporte_estado.SYD.completado || 0}}</td>
            <td>{{ reporte_estado.SYD.baja || 0}}</td>
            <td>{{ reporte_estado.SYD.media || 0}}</td>
            <td>{{ reporte_estado.SYD.alta || 0}}</td>
        </tr>
        <tr>
            <th>Crédito Socia Adicional</th>
            <td>{{ reporte_estado.TAD.pendiente || 0}}</td>
            <td>{{ reporte_estado.TAD.completado || 0}}</td>
            <td>{{ reporte_estado.TAD.baja || 0}}</td>
            <td>{{ reporte_estado.TAD.media || 0}}</td>
            <td>{{ reporte_estado.TAD.alta || 0}}</td>
        </tr>
        <tfoot>
            <tr>
                <th>Total</th>
                <th>{{ reporte_estado.total.pendiente || 0}}</th>
                <th>{{ reporte_estado.total.completado || 0}}</th>
                <th>{{ reporte_estado.total.baja || 0}}</th>
                <th>{{ reporte_estado.total.media || 0}}</th>
                <th>{{ reporte_estado.total.alta || 0}}</th>
            </tr>
        </tfoot>
    </tbody>
</table>
<?php
    ob_start();
?>
<script>
    reportes.reporte_estado_run = function() {
        const url = "/reportes/reporte_estado";
        $.ajax({
            url: url,
            method: 'get',
            dataType: 'json',
            success: (res) => {
                this.reporte_estado = res;
            }
        });
    };
</script>
<?php
    $script = ob_get_clean();
    $registerJs[] = $script;
