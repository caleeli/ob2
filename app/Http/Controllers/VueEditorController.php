<?php

namespace App\Http\Controllers;

use App\GDrive;
use App\Models\UserAdministration\HojaTrabajo;
use App\Models\UserAdministration\Tarea;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class VueEditorController extends Controller
{
    const pasos = [
        'EDC'=> [
            ['titulo'=>'1. Nota de solicitud y remisión de documentación a la empresa'],
            ['titulo'=>'2. Notas de solicitud y remisión de papeles de trabajo'],
            ['titulo'=>'3. Análisis de tendencia'],
            [
                'titulo'=>'4. Trabajo de campo',
                'buttons'=>[
                    'F-3007'=> [
                        'template'=>'1YQAdo90GE_5QxR6S5zos8oATeLFworldf8jXnbIHySI',
                        'name'=>'hojaTrabajo',
                    ]
                ]
            ],
            ['titulo'=>'5. Informe/Nota de Evaluación de Consistencias'],
            [
                'titulo'=>'6. Revisión',
                'buttons'=>[
                    'anexo4'=> [
                        'template'=>'1zxuEWTosPwlNSUapfg8KfaZr8d-GYohsRrFqjNKrXtU',
                        'name'=>'anexo4',
                    ]
                ]
            ],
            ['titulo'=>'7. Documento Aprobado'],
            ['titulo'=>'8. Remisión de Informe de Evaluación de Consistencia a Despacho'],
        ],
        'AUD'=> [
            ['titulo'=>'1. Recepción y Solicitud a Empresas y/o Firmas'],
            ['titulo'=>'2. Análisis de Tendencia'],
            [
                'titulo'=>'3. Trabajos de Campo',
                'buttons'=>[
                    'Form 1'=>[
                        'template'=>'1NBz72qVQzCIxrvXdHppUHSM6LLdFnBVeGHPgQqh8Hik',
                        'name'=>'hojaTrabajo1',
                    ],
                    'Form 2'=>[
                        'template'=>'1OIHs2pa9pqHvSxDFk6wMkwLs2Jbr2KHHONec6dFuWqU',
                        'name'=>'hojaTrabajo2',
                    ]
                ]
            ],
            ['titulo'=>'4. Informe'],
            ['titulo'=>'5. Revisión'],
            ['titulo'=>'6. Documento Aprobado'],
            ['titulo'=>'7. Remisión de Informe de Evaluación de Auditoría de Confiabilidad a Despacho'],
        ],
        'SUP'=>[
            ['titulo'=>'Solicitud / Denuncia / Requerimiento de la SCEP'],
            [
                'titulo'=>'Programa de Trabajo',
                'buttons'=>[
                    'Programa de Trabajo'=>[
                        'template'=>'1NZWQq66t6XQGHT22t-U8q7BI0b-Q0TSSAotf_lMe6Ow',
                        'name'=>'programaDeTrabajo',
                    ],
                ]
            ],
            [
                'titulo'=>'Informe',
                'buttons'=>[
                    //'Informe Supervisión'=>[
                    //],
                ]
            ],
            ['titulo'=>'Revisión / Inspección'],
            ['titulo'=>'Documento Aprobado'],
            ['titulo'=>'Remisión de Informe de Evaluación de Supervisión a Despacho'],
        ],
    ];

    public function edit($templeta, HojaTrabajo $hojaTrabajo = null)
    {
        $drive = new GDrive;
        $gTemplate = new \App\GTemplate($drive, $templeta);
        return view('hoja_trabajo', ['document' => $gTemplate->parse($hojaTrabajo)]);
    }

    public function editTarea($templeta, Tarea $tarea, $paso, $nombre)
    {
        $hoja = self::pasos[$tarea->tipo][$paso]['buttons'][$nombre]['name'];
        if (!isset($tarea->datos['data'][$paso][$hoja])) {
            $valores = [];
            $templetaActual = $templeta;
        } else {
            $valores = $tarea->datos['data'][$paso][$hoja]['valores'];
            $templetaActual = empty($tarea->datos['data'][$paso][$hoja]['templeta'])
                ? $templeta : $tarea->datos['data'][$paso][$hoja]['templeta'];
        }
        $drive = new GDrive;
        $gTemplate = new \App\GTemplate($drive, $templetaActual);
        return view('hoja_trabajo', [
            'document' => $gTemplate->parseVariables($valores ?: []),
            'autoSave'=>'saveTarea',
            'tarea'=>$tarea->getKey(),
            'tipoTarea'=>$tarea->tipo,
            'step'=>$paso,
            'fileName'=>$nombre,
        ]);
    }

    public function viewTarea($templeta, Tarea $tarea, $paso, $nombre)
    {
        $hoja = self::pasos[$tarea->tipo][$paso]['buttons'][$nombre]['name'];
        $valores = !empty($tarea->datos['data'][$paso][$hoja]['valores']) ? $tarea->datos['data'][$paso][$hoja]['valores']
            : [];
        $templetaActual = empty($tarea->datos['data'][$paso][$hoja]['templeta'])
            ? $templeta : $tarea->datos['data'][$paso][$hoja]['templeta'];
        $drive = new GDrive;
        $gTemplate = new \App\GTemplate($drive, $templetaActual);
        return view('hoja_trabajo', [
            'document' => $gTemplate->parseValores($valores),
            'tarea'=>$tarea->getKey(),
            'tipoTarea'=>$tarea->tipo,
            'step'=>$paso,
            'fileName'=>$nombre,
        ]);
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
        if ($storage!=='referencias') {
            $files = Storage::disk('referencias')->files('/');
            foreach ($files as $file) {
                if (strtolower(substr($file, -4)) != '.pdf') continue;
                $res[] = ['url' => env('APP_URL') . '/documentacion/referencias/' . $file, 'name' => basename($file)];
            }
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
    public function editPDF(Request $request, $storage=null, ...$path)
    {
        $filePath = implode('/', $path);
        $marksFile = $filePath . '.marks';
        $data = [
            'marks' => [],
            'ids' => [],
            'metas' => [],
        ];
        $defaultSP = $storage==='tareas' && !empty($path[0]) ? $storage . '/' . $path[0] : ($storage ? $storage : 'referencias');
        $storePath = $request->input('sp', $defaultSP);
        if ($storage) {
            if (Storage::disk($storage)->exists($marksFile)) {
                $data = json_decode(Storage::disk($storage)->get($marksFile), true);
                if (!$data) $data = [];
                if (!isset($data['marks'])) {
                    $marks = $data;
                    $data['marks'] = $marks;
                    $data['ids'] = [];
                    $data['metas'] = [];
                    $defaultTitle = '1.';
                    foreach($marks as $m) {
                        $data['ids'][] = 0;
                    }
                    $data['metas'][] = [
                        'id' => 0,
                        'title' => $defaultTitle,
                        'description' => '',
                        'file' => '',
                        'reference' => '',
                    ];
                }
            }
        }
        return view('pdf_edit', [
            'pdfPath' => $storage . '/' . $filePath,
            'pdfMarks' => $data['marks'],
            'markIds' => $data['ids'],
            'markMetas' => $data['metas'],
            'mode'=>'edit',
            'storePath' => $storePath,
        ]);
    }

    /**
     * Muestra un PDF con marcas.
     *
     * @param string $store
     * @param array ...$path
     *
     * @return View
     */
    public function viewPDF(Request $request, $storage=null, ...$path)
    {
        $filePath = implode('/', $path);
        $marksFile = $filePath . '.marks';
        $data = [
            'marks' => [],
            'ids' => [],
            'metas' => [],
        ];
        $defaultSP = $storage==='tareas' && !empty($path[0]) ? $storage . '/' . $path[0] : ($storage ? $storage : 'referencias');
        $storePath = $request->input('sp', $defaultSP);
        if ($storage) {
            if (Storage::disk($storage)->exists($marksFile)) {
                $data = json_decode(Storage::disk($storage)->get($marksFile), true);
                if (!$data) $data = [];
                if (!isset($data['marks'])) {
                    $marks = $data;
                    $data['marks'] = $marks;
                    $data['ids'] = [];
                    $data['metas'] = [];
                    $defaultTitle = '1.';
                    foreach($marks as $m) {
                        $data['ids'][] = 0;
                    }
                    $data['metas'][] = [
                        'id' => 0,
                        'title' => $defaultTitle,
                        'description' => '',
                        'file' => '',
                        'reference' => '',
                    ];
                }
            }
        }
        return view('pdf_edit', [
            'pdfPath' => $storage . '/' . $filePath,
            'pdfMarks' => $data['marks'],
            'markIds' => $data['ids'],
            'markMetas' => $data['metas'],
            'mode'=>'view',
            'storePath' => $storePath,
        ]);
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
