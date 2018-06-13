<?php

namespace App\Http\Controllers;

use App\GDrive;
use App\Models\UserAdministration\HojaTrabajo;
use App\Models\UserAdministration\Tarea;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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

    public function listPDFStorage($storage, ...$path)
    {
        $directory = implode('/', $path);
        $res = [];
        $files = Storage::disk($storage)->allFiles($directory);
        foreach ($files as $file) {
            if (strtolower(substr($file, -4)) != '.pdf') continue;
            $res[] = ['url' => $this->getStorageUrl($storage, $file), 'name' => basename($file)];
        }
        //Agrega los files de referencias tambien
        $files = Storage::disk('referencias')->files('/');
        foreach ($files as $file) {
            if (strtolower(substr($file, -4)) != '.pdf') continue;
            $res[] = ['url' => env('APP_URL') . '/documentacion/referencias/' . $file, 'name' => basename($file)];
        }
        return $res;
    }

    /**
     * Muestra un PDF con marcas.
     *
     * @param string $store
     * @param array ...$path
     *
     * @return View
     */
    public function editPDF($storage=null, ...$path)
    {
        $filePath = implode('/', $path);
        $marksFile = $filePath . '.marks';
        $marks = [];
        if ($storage) {
            if (Storage::disk($storage)->exists($marksFile)) {
                $marks = json_decode(Storage::disk($storage)->get($marksFile));
                if (!$marks) $marks = [];
            }
        }
        return view('pdf_edit', ['pdfPath' => $storage . '/' . $filePath, 'pdfMarks' => $marks, 'mode'=>'edit']);
    }

    /**
     * Muestra un PDF con marcas.
     *
     * @param string $store
     * @param array ...$path
     *
     * @return View
     */
    public function viewPDF($storage=null, ...$path)
    {
        $filePath = implode('/', $path);
        $marksFile = $filePath . '.marks';
        $marks = [];
        if ($storage) {
            if (Storage::disk($storage)->exists($marksFile)) {
                $marks = json_decode(Storage::disk($storage)->get($marksFile));
                if (!$marks) $marks = [];
            }
        }
        return view('pdf_edit', ['pdfPath' => $storage . '/' . $filePath, 'pdfMarks' => $marks, 'mode'=>'view']);
    }

    /**
     * Marca un PDF.
     *
     * @param string $store
     * @param array ...$path
     *
     * @return View
     */
    public function markPDF(Request $request, $storage, ...$path)
    {
        $filePath = implode('/', $path);
        $marksFile = $filePath . '.marks';
        $marks = $request->getContent();
        Storage::disk($storage)->put($marksFile, $marks);
        return $marks;
    }

    private function getStorageConfig($storage)
    {
        return config('filesystems.disks')[$storage];
    }

    private function getStorageUrl($storage, $filename)
    {
        $config = $this->getStorageConfig($storage);
        return isset($config['urlBase']) ? asset($config['urlBase'] . $filename) : '';
    }
}
