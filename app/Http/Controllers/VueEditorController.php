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

    public function viewTarea($templeta, Tarea $tarea, $indice)
    {
        $drive = new GDrive;
        $gTemplate = new \App\GTemplate($drive, $templeta);
        $valores = $tarea->datos['data'][$indice]['hojaTrabajo']['valores'];
        header('Content-Type: application/msword');
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $tarea->datos['data'][$indice]['hojaTrabajo']['titulo']. '.doc');
        header('Content-Transfer-Encoding: binary');
        header('Connection: Keep-Alive');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
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
