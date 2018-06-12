<?php

namespace App\Http\Controllers;

use App\GDrive;
use App\Models\UserAdministration\HojaTrabajo;
use App\Models\UserAdministration\Tarea;
use Illuminate\Support\Facades\Storage;

class VueEditorController extends Controller
{

    public function edit($templeta, HojaTrabajo $hojaTrabajo = null)
    {
        $drive = new GDrive;
        $gTemplate = new \App\GTemplate($drive, $templeta);
        return view('hoja_trabajo', ['document' => $gTemplate->parse($hojaTrabajo)]);
    }

    public function editTarea($templeta, Tarea $tarea, $indice)
    {
        $drive = new GDrive;
        $gTemplate = new \App\GTemplate($drive, $templeta);
        $valores = $tarea->datos['data'][$indice]['hojaTrabajo']['valores'];
        return view('hoja_trabajo', ['document' => $gTemplate->parseVariables($valores ?: []), 'autoSave'=>'saveTarea']);
    }

    public function viewTarea($templeta, Tarea $tarea, $indice)
    {
        $drive = new GDrive;
        $gTemplate = new \App\GTemplate($drive, $templeta);
        $valores = $tarea->datos['data'][$indice]['hojaTrabajo']['valores'];
        return view('hoja_trabajo', ['document' => $gTemplate->parseValores($valores)]);
    }

    public function index($path)
    {
        $drive = new GDrive;
        return response()->json($drive->files($path));
    }

    public function listPDFs()
    {
        $res = [];
        $files = Storage::disk('referencias')->files('/');
        foreach ($files as $file) {
            if (strtolower(substr($file, -4)) != '.pdf') continue;
            $res[] = ['url' => env('APP_URL') . '/documentacion/referencias/' . $file, 'name' => basename($file)];
        }
        return $res;
    }
}
