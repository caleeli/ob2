<?php

namespace App\Http\Controllers;

use App\GDrive;
use App\Models\UserAdministration\HojaTrabajo;
use App\Models\UserAdministration\Tarea;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class VueEditorController extends Controller
{
    public static function getPasos()
    {
        $defaultPasos = [
            'EDC'=> [
                [
                    'titulo'=>'1. Plantilla de revisión',
                    'porcentaje' => 30,
                    'buttons'=>[
                        'revision'=> [
                            'template'=>'1snOSeUYDeuKIWcCHHiqR9ZTFe2NDrfFZyaPnA4GWjfI',
                            'buttonTitle' => 'Plantilla de Revisión',
                            'name'=>'revision',
                        ]
                    ],
                ],
                [
                    'titulo'=>'2. Respuesta de la Agencia',
                    'porcentaje' => 30,
                    'buttons'=>[
                        'revision'=> [
                            'template'=>'1UfSniy8r9-T4umisvhd9z7cLTdeG6Q8bQyEvstRF5jE',
                            'buttonTitle' => 'Responder Revisión',
                            'name'=>'revision',
                        ]
                    ],
                ],
                ['titulo'=>'3. Informe Final'],
                [
                    'titulo'=>'4. Conclusión',
                ],
            ],
            'AUD' => [
                [
                    'titulo'=>'1. Plantilla de revisión',
                    'porcentaje' => 30,
                    'buttons'=>[
                        'revision'=> [
                            'template'=>'1snOSeUYDeuKIWcCHHiqR9ZTFe2NDrfFZyaPnA4GWjfI',
                            'buttonTitle' => 'Plantilla de Revisión',
                            'name'=>'revision',
                        ]
                    ],
                ],
                ['titulo'=>'2. Respuesta de la Agencia'],
                ['titulo'=>'3. Informe Final'],
                [
                    'titulo'=>'4. Conclusión',
                ],
            ],
            'SUP' => [
                [
                    'titulo'=>'1. Plantilla de revisión',
                    'porcentaje' => 30,
                    'buttons'=>[
                        'revision'=> [
                            'template'=>'1snOSeUYDeuKIWcCHHiqR9ZTFe2NDrfFZyaPnA4GWjfI',
                            'buttonTitle' => 'Plantilla de Revisión',
                            'name'=>'revision',
                        ]
                    ],
                ],
                ['titulo'=>'2. Respuesta de la Agencia'],
                ['titulo'=>'3. Informe Final'],
                [
                    'titulo'=>'4. Conclusión',
                ],
            ],
            'RDI' => [
                [
                    'titulo'=>'1. Plantilla de revisión',
                    'porcentaje' => 30,
                    'buttons'=>[
                        'revision'=> [
                            'template'=>'1snOSeUYDeuKIWcCHHiqR9ZTFe2NDrfFZyaPnA4GWjfI',
                            'buttonTitle' => 'Plantilla de Revisión',
                            'name'=>'revision',
                        ]
                    ],
                ],
                ['titulo'=>'2. Respuesta de la Agencia'],
                ['titulo'=>'3. Informe Final'],
                [
                    'titulo'=>'4. Conclusión',
                ],
            ],
            'COD' => [
                [
                    'titulo'=>'1. Plantilla de revisión',
                    'porcentaje' => 30,
                    'buttons'=>[
                        'revision'=> [
                            'template'=>'1snOSeUYDeuKIWcCHHiqR9ZTFe2NDrfFZyaPnA4GWjfI',
                            'buttonTitle' => 'Plantilla de Revisión',
                            'name'=>'revision',
                        ]
                    ],
                ],
                ['titulo'=>'2. Respuesta de la Agencia'],
                ['titulo'=>'3. Informe Final'],
                [
                    'titulo'=>'4. Conclusión',
                ],
            ],
            'EIU' => [
                [
                    'titulo'=>'1. Plantilla de revisión',
                    'porcentaje' => 30,
                    'buttons'=>[
                        'revision'=> [
                            'template'=>'1snOSeUYDeuKIWcCHHiqR9ZTFe2NDrfFZyaPnA4GWjfI',
                            'buttonTitle' => 'Plantilla de Revisión',
                            'name'=>'revision',
                        ]
                    ],
                ],
                ['titulo'=>'2. Respuesta de la Agencia'],
                ['titulo'=>'3. Informe Final'],
                [
                    'titulo'=>'4. Conclusión',
                ],
            ],
            'EIP' => [
                [
                    'titulo'=>'1. Plantilla de revisión',
                    'porcentaje' => 30,
                    'buttons'=>[
                        'revision'=> [
                            'template'=>'1snOSeUYDeuKIWcCHHiqR9ZTFe2NDrfFZyaPnA4GWjfI',
                            'buttonTitle' => 'Plantilla de Revisión',
                            'name'=>'revision',
                        ]
                    ],
                ],
                ['titulo'=>'2. Respuesta de la Agencia'],
                ['titulo'=>'3. Informe Final'],
                [
                    'titulo'=>'4. Conclusión',
                ],
            ],
            'SYD' => [
                [
                    'titulo'=>'1. Plantilla de revisión',
                    'porcentaje' => 30,
                    'buttons'=>[
                        'revision'=> [
                            'template'=>'1snOSeUYDeuKIWcCHHiqR9ZTFe2NDrfFZyaPnA4GWjfI',
                            'buttonTitle' => 'Plantilla de Revisión',
                            'name'=>'revision',
                        ]
                    ],
                ],
                ['titulo'=>'2. Respuesta de la Agencia'],
                ['titulo'=>'3. Informe Final'],
                [
                    'titulo'=>'4. Conclusión',
                ],
            ],
            'TAD' => [
                [
                    'titulo'=>'1. Plantilla de revisión',
                    'porcentaje' => 30,
                    'buttons'=>[
                        'revision'=> [
                            'template'=>'1snOSeUYDeuKIWcCHHiqR9ZTFe2NDrfFZyaPnA4GWjfI',
                            'buttonTitle' => 'Plantilla de Revisión',
                            'name'=>'revision',
                        ]
                    ],
                ],
                ['titulo'=>'2. Respuesta de la Agencia'],
                ['titulo'=>'3. Informe Final'],
                [
                    'titulo'=>'4. Conclusión',
                ],
            ],
        ];
        // Get from local storage
        $path = '/home/david/projects/diaconia_demo/storage/app/pasos.json';// storage_path('app/pasos.json');
        if (\file_exists($path)) {
            $pasos = \file_get_contents($path);
            $pasos = json_decode($pasos, true);
        } else {
            $pasos = $defaultPasos;
        }
        return $pasos;
    }

    public static function postPasos($nuevosPasos, $tipo)
    {
        $pasosDef = self::getPasos();
        $pasos = $pasosDef[$tipo];
        foreach ($nuevosPasos as $i => $paso) {
            $pasos[$i]['titulo'] = $paso['name'];
            if (isset($paso['extra']['porcentaje'])) {
                $pasos[$i]['porcentaje'] = $paso['extra']['porcentaje'];
            }
            if ($paso['implementation']) {
                $template = self::findTemplate($paso['implementation']);
                if ($template) {
                    $pasos[$i]['buttons'] = [
                        'revision'=> [
                            'template' => $template->id,
                            'buttonTitle' => 'Llenar plantilla',
                            'name' => 'revision',
                        ],
                    ];
                }
            } else {
                $pasos[$i]['buttons'] = [];
            }
        }
        $pasosDef[$tipo] = $pasos;
        // Store to local storage
        Storage::disk('local')->put('pasos.json', json_encode(
            $pasosDef,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        ));
    }

    private static function findTemplate($templateName)
    {
        $index = json_decode(file_get_contents(public_path('plantillas/index.json')));
        foreach ($index as $template) {
            if (isset($template->file) && $template->file == $templateName) {
                return $template;
            }
        }
    }

    public function edit($templeta, HojaTrabajo $hojaTrabajo = null)
    {
        $drive = new GDrive;
        $gTemplate = new \App\GTemplate($drive, $templeta);
        return view('hoja_trabajo', ['document' => $gTemplate->parse($hojaTrabajo)]);
    }

    public function editTarea($templeta, Tarea $tarea, $paso, $nombre)
    {
        $hoja = self::getPasos()[$tarea->tipo][$paso]['buttons'][$nombre]['name'];
        if (!isset($tarea->datos['data'][$paso][$hoja])) {
            $valores = $this->valorPrevio($tarea, $paso, $hoja);
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
            'templetaActual' => $templetaActual,
        ]);
    }

    public function viewTarea($templeta, Tarea $tarea, $paso, $nombre)
    {
        /*$hoja = self::pasos[$tarea->tipo][$paso]['buttons'][$nombre]['name'];
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
            'templetaActual' => $templetaActual,
        ]);*/
        $hoja = self::getPasos()[$tarea->tipo][$paso]['buttons'][$nombre]['name'];
        if (!isset($tarea->datos['data'][$paso][$hoja])) {
            $valores = $this->valorPrevio($tarea, $paso, $hoja);
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
            'autoSave'=>false, //'saveTarea',
            'tarea'=>$tarea->getKey(),
            'tipoTarea'=>$tarea->tipo,
            'step'=>$paso,
            'fileName'=>$nombre,
            'templetaActual' => $templetaActual,
            'readOnly' => true,
        ]);
    }

    private function valorPrevio($tarea, $paso, $hoja)
    {
        while($paso>0) {
            $paso--;
            if (isset($tarea->datos['data'][$paso][$hoja])) {
                return $tarea->datos['data'][$paso][$hoja]['valores'];
            }
        }
        return [];
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
