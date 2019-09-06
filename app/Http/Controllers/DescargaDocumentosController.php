<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class DescargaDocumentosController extends Controller
{
    public function index($tarea)
    {
        $drive = Storage::drive('tareas');
        $list = $drive->allFiles($tarea);
        $files = [];
        foreach ($list as $file) {
            $name = basename($file);
            $url = '/documentacion/tareas/' . $file;
            if (substr($name, 0, 1) === '.') {
                continue;
            }
            if (substr($file, -5) === '.link') {
                $link = json_decode($drive->get($file));
                if ($link && $link->url) {
                    $url = '/descarga_documentos/print?url=' . urlencode($link->url);
                } else {
                    continue;
                }
            }
            $files[] = [
                'name' => $name,
                'url' => $url,
            ];
        }
        return view('descarga_documentos', compact('files'));
    }

    public function file($fileKey)
    {
        $file = decrypt($fileKey);
        return \Storage::drive('tareas')->download($file);
    }

    public function printPDF()
    {
        $path = request('url');
        $url = url($path);
        $pdf = uniqid(public_path('/storage/', true)) . '.pdf';
        exec(env('NODE', 'node') . ' '.base_path('/node_modules/chrome-headless-render-pdf/dist/cli/chrome-headless-render-pdf.js'). ' --url='. escapeshellarg($url) . ' --pdf=' . $pdf);
        return redirect('/storage/' . basename($pdf));
    }
}
