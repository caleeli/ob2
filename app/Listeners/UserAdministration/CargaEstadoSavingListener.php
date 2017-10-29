<?php
namespace App\Listeners\UserAdministration;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\UserAdministration\CargaEstado;
use App\Events\UserAdministration\CargaEstadoSaving;

class CargaEstadoSavingListener
{
    public $cargaEstado = null;
    public function handle($event)
    {
        $files = $event->cargaEstado->files;
        foreach ($files as $file) {
            list($name, $ext) = explode('.', strtolower($file['name']));
            list($cod, $emp, $gestion, $estado) = explode('_', $name);
            $em = \App\Models\UserAdministration\Empresa
                                ::where('cod_empresa', '=', $cod)
                                ->first();
            if (!$em) {
                continue;
            }
            $estadoF = [
                                'bg'=>'Balance General',
                                'erg'=>'Estado de Resultados y Gastos',
                            ][$estado];
            $eeff = \App\Models\UserAdministration\EstadoFinanciero
                                ::where('empresa_id', '=', $em->id)
                                ->where('gestion', '=', $gestion)
                                ->where('tipo_estado_financiero', '=', $estadoF)
                                ->get();
            $ok = false;
            foreach ($eeff as $ef) {
                $extF = strtolower(@array_pop(explode('.', $ef->archivo['name'])));
                if (($ext==='xls' || $ext==='xlsx') && ($extF==='xls' || $extF==='xlsx')) {
                    $ef->archivo = $file;
                    $ef->save();
                    $ok = true;
                    break;
                }
                if (($ext==='pdf') && ($extF==='pdf')) {
                    $ef->archivo = $file;
                    $ef->save();
                    $ok = true;
                    break;
                }
            }
            if (!$ok) {
                $ef = new \App\Models\UserAdministration\EstadoFinanciero;
                $ef->empresa_id = $em->id;
                $ef->gestion = $gestion;
                $ef->tipo_estado_financiero = $estadoF;
                $ef->archivo = $file;
                $ef->save();
            }
        }
    }
}
