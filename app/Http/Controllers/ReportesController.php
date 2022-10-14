<?php

namespace App\Http\Controllers;

use App\GDrive;
use App\GTemplate;
use App\Models\UserAdministration\Tarea;

class ReportesController extends Controller
{

    /**
     * /reportes/{name}
     */
    public function index($name)
    {
        return $this->$name();
    }

    public function reporte_estado()
    {
        $reporte_estado = [
            'EDC' => [
                'pendiente' => 0,
                'completado' => 0,
                'baja' => 0,
                'media' => 0,
                'alta' => 0,
            ],
            'AUD' => [
                'pendiente' => 0,
                'completado' => 0,
                'baja' => 0,
                'media' => 0,
                'alta' => 0,
            ],
            'SUP' => [
                'pendiente' => 0,
                'completado' => 0,
                'baja' => 0,
                'media' => 0,
                'alta' => 0,
            ],
            'RDI' => [
                'pendiente' => 0,
                'completado' => 0,
                'baja' => 0,
                'media' => 0,
                'alta' => 0,
            ],
            'COD' => [
                'pendiente' => 0,
                'completado' => 0,
                'baja' => 0,
                'media' => 0,
                'alta' => 0,
            ],
            'EIU' => [
                'pendiente' => 0,
                'completado' => 0,
                'baja' => 0,
                'media' => 0,
                'alta' => 0,
            ],
            'EIP' => [
                'pendiente' => 0,
                'completado' => 0,
                'baja' => 0,
                'media' => 0,
                'alta' => 0,
            ],
            'SYD' => [
                'pendiente' => 0,
                'completado' => 0,
                'baja' => 0,
                'media' => 0,
                'alta' => 0,
            ],
            'TAD' => [
                'pendiente' => 0,
                'completado' => 0,
                'baja' => 0,
                'media' => 0,
                'alta' => 0,
            ],
            'total' => [
                'pendiente' => 0,
                'completado' => 0,
                'baja' => 0,
                'media' => 0,
                'alta' => 0,
            ],
        ];

        $reporte_estado['EDC']['pendiente'] = $this->contar_tareas('EDC', 'Pendiente');
        $reporte_estado['EDC']['completado'] = $this->contar_tareas('EDC', 'Completado');
        $reporte_estado['EDC']['baja'] = $this->contar_tareas('EDC', 'Baja');
        $reporte_estado['EDC']['media'] = $this->contar_tareas('EDC', 'Media');
        $reporte_estado['EDC']['alta'] = $this->contar_tareas('EDC', 'Alta');

        $reporte_estado['AUD']['pendiente'] = $this->contar_tareas('AUD', 'Pendiente');
        $reporte_estado['AUD']['completado'] = $this->contar_tareas('AUD', 'Completado');
        $reporte_estado['AUD']['baja'] = $this->contar_tareas('AUD', 'Baja');
        $reporte_estado['AUD']['media'] = $this->contar_tareas('AUD', 'Media');
        $reporte_estado['AUD']['alta'] = $this->contar_tareas('AUD', 'Alta');

        $reporte_estado['SUP']['pendiente'] = $this->contar_tareas('SUP', 'Pendiente');
        $reporte_estado['SUP']['completado'] = $this->contar_tareas('SUP', 'Completado');
        $reporte_estado['SUP']['baja'] = $this->contar_tareas('SUP', 'Baja');
        $reporte_estado['SUP']['media'] = $this->contar_tareas('SUP', 'Media');
        $reporte_estado['SUP']['alta'] = $this->contar_tareas('SUP', 'Alta');

        $reporte_estado['RDI']['pendiente'] = $this->contar_tareas('RDI', 'Pendiente');
        $reporte_estado['RDI']['completado'] = $this->contar_tareas('RDI', 'Completado');
        $reporte_estado['RDI']['baja'] = $this->contar_tareas('RDI', 'Baja');
        $reporte_estado['RDI']['media'] = $this->contar_tareas('RDI', 'Media');
        $reporte_estado['RDI']['alta'] = $this->contar_tareas('RDI', 'Alta');

        $reporte_estado['COD']['pendiente'] = $this->contar_tareas('COD', 'Pendiente');
        $reporte_estado['COD']['completado'] = $this->contar_tareas('COD', 'Completado');
        $reporte_estado['COD']['baja'] = $this->contar_tareas('COD', 'Baja');
        $reporte_estado['COD']['media'] = $this->contar_tareas('COD', 'Media');
        $reporte_estado['COD']['alta'] = $this->contar_tareas('COD', 'Alta');

        $reporte_estado['EIU']['pendiente'] = $this->contar_tareas('EIU', 'Pendiente');
        $reporte_estado['EIU']['completado'] = $this->contar_tareas('EIU', 'Completado');
        $reporte_estado['EIU']['baja'] = $this->contar_tareas('EIU', 'Baja');
        $reporte_estado['EIU']['media'] = $this->contar_tareas('EIU', 'Media');
        $reporte_estado['EIU']['alta'] = $this->contar_tareas('EIU', 'Alta');

        $reporte_estado['EIP']['pendiente'] = $this->contar_tareas('EIP', 'Pendiente');
        $reporte_estado['EIP']['completado'] = $this->contar_tareas('EIP', 'Completado');
        $reporte_estado['EIP']['baja'] = $this->contar_tareas('EIP', 'Baja');
        $reporte_estado['EIP']['media'] = $this->contar_tareas('EIP', 'Media');
        $reporte_estado['EIP']['alta'] = $this->contar_tareas('EIP', 'Alta');

        $reporte_estado['SYD']['pendiente'] = $this->contar_tareas('SYD', 'Pendiente');
        $reporte_estado['SYD']['completado'] = $this->contar_tareas('SYD', 'Completado');
        $reporte_estado['SYD']['baja'] = $this->contar_tareas('SYD', 'Baja');
        $reporte_estado['SYD']['media'] = $this->contar_tareas('SYD', 'Media');
        $reporte_estado['SYD']['alta'] = $this->contar_tareas('SYD', 'Alta');

        $reporte_estado['TAD']['pendiente'] = $this->contar_tareas('TAD', 'Pendiente');
        $reporte_estado['TAD']['completado'] = $this->contar_tareas('TAD', 'Completado');
        $reporte_estado['TAD']['baja'] = $this->contar_tareas('TAD', 'Baja');
        $reporte_estado['TAD']['media'] = $this->contar_tareas('TAD', 'Media');
        $reporte_estado['TAD']['alta'] = $this->contar_tareas('TAD', 'Alta');

        $reporte_estado['total']['pendiente'] = array_sum(array_column($reporte_estado, 'pendiente'));
        $reporte_estado['total']['completado'] = array_sum(array_column($reporte_estado, 'completado'));
        $reporte_estado['total']['baja'] = array_sum(array_column($reporte_estado, 'baja'));
        $reporte_estado['total']['media'] = array_sum(array_column($reporte_estado, 'media'));
        $reporte_estado['total']['alta'] = array_sum(array_column($reporte_estado, 'alta'));

        return $reporte_estado;
    }

    private function contar_tareas($tipo, $prioridad_estado)
    {
        switch ($prioridad_estado) {
            case 'Pendiente':
            case 'Completado':
                $tareas = Tarea::where('tipo', $tipo)->where('estado', $prioridad_estado);
                break;
            default:
                $tareas = Tarea::where('tipo', $tipo)->where('prioridad', $prioridad_estado);
        }
        return $tareas->count();
    }

    public function reporte_cumplimiento()
    {
        $plantillaId = "1snOSeUYDeuKIWcCHHiqR9ZTFe2NDrfFZyaPnA4GWjfI";
        $labels = $this->getPreguntas($plantillaId);
        // Buscar tareas que contiene plantillaId en data
        $tareas = Tarea::where('datos', 'like', '%' . $plantillaId . '%')->get();
        // contar checks
        $reporte = [];
        foreach ($labels as $key => $label) {
            $reporte[$key] = [
                'label' => $label,
                'cumple' => 0,
                'no_cumple' => 0,
                'no_aplica' => 0,
            ];
        }
        foreach ($tareas as $tarea) {
            if (empty($tarea->datos['data'])) {
                continue;
            }
            foreach($tarea->datos['data'] as $paso) {
                if (empty($paso['revision']) || empty($paso['revision']['valores'])) {
                    continue;
                }
                $valores = $paso['revision']['valores'];
                foreach($valores as $key => $value) {
                    if (substr($key,0, 5) === 'check') {
                        $cumple = $value === "✔";
                        $no_cumple = $value === "✕";
                        $no_aplica = $value === "N/A";
                        // $parcial = $value === "P/C";
                        if ($cumple) {
                            $reporte[$key]['cumple']++;
                        } elseif ($no_cumple) {
                            $reporte[$key]['no_cumple']++;
                        } elseif ($no_aplica) {
                            $reporte[$key]['no_aplica']++;
                        }
                    }
                }
            }
        }
        return array_values($reporte);
    }

    private function getPreguntas($plantillaId)
    {
        $drive = new GDrive;
        $gTemplate = new GTemplate($drive, $plantillaId);
        list($html, $variables, $multiples, $labels) = $gTemplate->parseVariablesMeta([], true);
        return $labels;
    }
}
