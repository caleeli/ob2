<table v-if="reporte_cumplimiento" class="report">
    <thead>
        <tr>
            <th></th>
            <th colspan="3">Estado</th>
        </tr>
        <tr>
            <th></th>
            <th>Cumple</th>
            <th>No Cumple</th>
            <th>N/A</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(item, index) in reporte_cumplimiento.data">
            <td style="text-align: justify;">{{ item.label }}</td>
            <td>{{ item.cumple }}</td>
            <td>{{ item.no_cumple }}</td>
            <td>{{ item.no_aplica }}</td>
        </tr>
    </tbody>
</table>

<div v-if="reporte_cumplimiento" style="width:60rem;">
    <basic-chart title="Por Estado" refreshWith="reporte_cumplimiento" type="pie"
        v-bind:mdata='reporte_cumplimiento.chart' />
</div>

<p><br></p>
<?php
    ob_start();
?>
<script>
    reportes.reporte_cumplimiento_run = function() {
        const url = "/reportes/reporte_cumplimiento";
        $.ajax({
            url: url,
            method: 'get',
            dataType: 'json',
            success: (res) => {
                const tipos = [
                    'Cumple',
                    'No Cumple',
                    'No Aplica',
                ];
                const chart = {
                    x: Object.values(tipos),
                    series: {
                        Total: {
                            Conteo: Object.values(res.reduce((obj, row) => ({
                                cumple: obj.cumple + row.cumple,
                                no_cumple: obj.no_cumple + row.no_cumple,
                                no_aplica: obj.no_aplica + row.no_aplica,
                            }), {
                                cumple: 0,
                                no_cumple: 0,
                                no_aplica: 0
                            })),
                        }
                    }
                };
                console.log(chart);
                this.reporte_cumplimiento = {
                    chart,
                    data: res
                };
            }
        });
    };
</script>
<?php
    $script = ob_get_clean();
    $registerJs[] = $script;
