<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;

class CuadroFinanciero extends Model
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'adm_cuadro_financieros';
    protected $fillable = array(
      0 => 'titulo',
      1 => 'contenido',
      2 => 'grafico',
    );
    protected $attributes = array(
      'titulo' => '',
      'contenido' => '',
      'grafico' => '',
    );
    protected $casts = array(
      'titulo' => 'string',
      'contenido' => 'string',
      'grafico' => 'string',
    );
    protected $events = array(
    );
    public function calculate($empresaId, $gestion, $html, $grafico='{}')
    {
        $ev = new \App\Evaluator($empresaId, $gestion, ['Balance General', 'Estado de Resultados y Gastos']);
        $ev2 = new \App\Evaluator($empresaId, $gestion, ['Estado de Ejecución Presupuestaria de Gastos']);
        $ppto = '<p class="desc-ind">La empresa cuenta con un presupuesto de Bs. {{$uf("Presup%Vig%")}}</p>
        <table style="height: 223px;" width="100%">
		<tbody>
		<tr>
		<td style="color: white; width: 236px;" rowspan="2">
		<div class="widget" style="text-align: center; background-color: #29B294; margin: 0px 12px 0px 0px; padding: 62px 0;">
		<h2>Bs. {{$uf("Presup%Vig%")}}</h2>
		<p>&nbsp;</p>
		<p>PRESUPUESTO&nbsp;</p>
		</div>
		</td>
		</tr>
		</tbody>
		</table>';
        return [$ev->calculate($html), $ev2->calculate($ppto), $ev->calculate($grafico, true)];
    }

    public function cuentaAbrir($empresa, $gestion)
    {
        $ev = new \App\Evaluator($empresa, $gestion, ['Balance General', 'Estado de Resultados y Gastos']);
        return [
                                'bg' => [
                                    '1' => $ev->calculate('{{$uc("1")}}'),
                                    '1.1' => $ev->calculate('{{$uc("1.1")}}'),
                                    '1.1.1.2' => $ev->calculate('{{$uc("1.1.1.2")}}'),
                                    '1.1.5' => $ev->calculate('{{$uc("1.1.5")}}'),
                                    '2' => $ev->calculate('{{$uc("2")}}'),
                                    '2.1' => $ev->calculate('{{$uc("2.1")}}'),
                                ],
                                'erg' => [
                                    '5' => $ev->calculate('{{$uc("5")}}'),
                                    '6' => $ev->calculate('{{$uc("6")}}'),
                                    'Resultado del Ejercicio:' => $ev->calculate('{{$uc("Resultado del Ejercicio:")}}'),
                                ],
                            ];
    }

    public function cuentaGuardar($empresa, $gestion, $cuenta, $valores)
    {
        $tipo = [
                                'bg' => 'Balance General',
                                'erg' => 'Estado de Resultados y Gastos',
                            ];
        $estado = new \App\Models\UserAdministration\EstadoFinanciero;
        $estado->tipo_estado_financiero = $tipo[$cuenta];
        $estado->gestion = $gestion;
        $estado->empresa_id = $empresa;
        $emp = \App\Models\UserAdministration\Empresa::find($empresa);
        $codigo = $emp->cod_empresa ?: 'i' . $emp->id;
        $estado->prefix = "datos_{$codigo}_{$gestion}_" . $cuenta;
        $nombre = preg_replace('/\W/', '', $emp->nombre_empresa);
        $filename = $emp->cod_empresa.'_'.$nombre.'_'.$gestion.'_'.$cuenta.'.xls';
        $estado->archivo = [
                                'name' => $filename,
                                'mime' => 'application/vnd.ms-excel',
                                'path' => storage_path('app/public/' . $filename),
                                'url' => url('storage/' . $filename),
                            ];
        \Storage::put('public/' . $filename, view('estadofinanciero', ['valores'=>$valores])->render());
        $table = $estado->prefix . '_1';
        \DB::statement('DROP TABLE IF EXISTS "' . $table . '"');
        \DB::statement('CREATE TABLE "public"."' . $table . '" ("Columna_A" text, "Columna_B" text, "id" serial NOT NULL) WITH (oids = false)');
        foreach ($valores as $valor) {
            \DB::table($table)->insert([
                                    'Columna_A' => $valor['nro'],
                                    'Columna_B' => $valor['valor'],
                                ]);
        }
        $estado->tablas = [
                                [
                                    'number' => 1,
                                    'source' => storage_path('app/public/' . $filename),
                                    'name' => $cuenta,
                                    'table_name' => $table,
                                    'file' => storage_path('app/public/' . $filename),
                                    'columns' => ["Columna_A","Columna_B"],
                                    'rows' => count($valores),
                                ]
                            ];
        $estado->save();
        \App\Models\UserAdministration\EstadoFinanciero::where('empresa_id', $empresa)
                            ->where('gestion', $gestion)
                            ->where('tipo_estado_financiero', $tipo[$cuenta])
                            ->where('id', '!=', $estado->id)
                            ->delete();
        return $estado->toArray();
    }
}
