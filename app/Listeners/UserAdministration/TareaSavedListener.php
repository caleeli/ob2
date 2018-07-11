<?php
namespace App\Listeners\UserAdministration;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\UserAdministration\Tarea;
use App\Events\UserAdministration\TareaSaved;
use Illuminate\Support\Facades\Storage;

class TareaSavedListener
{
    public $tarea = null;
    public function handle($event)
    {
        if (!$event->tarea->cod_tarea) {
            $event->tarea->cod_tarea = "SCEP-" . $event->tarea->id;
            $event->tarea->save();
        }
        $defs = \App\Http\Controllers\VueEditorController::pasos;
        if (isset($defs[$event->tarea->tipo])) {
            $def = $defs[$event->tarea->tipo];
            for ($paso = 0, $l = count($def); $paso<$l; $paso++) {
                if (!isset($def[$paso]['buttons'])) {
                    continue;
                }
                foreach ($def[$paso]['buttons'] as $hojaNombre => $hojaDef) {
                    $hojaTrabajo = $hojaDef['name'];
                    if (!empty($event->tarea->datos['data'][$paso][$hojaTrabajo])) {
                        $hoja = $event->tarea->datos['data'][$paso][$hojaTrabajo];
                        $titulo = $hoja['titulo'];
                        $filename = $event->tarea->id . '/' . ($paso + 1) . '/' . $titulo . '.link';
                        $url = "/vue-editor/download/" . $hoja['templeta'] . "/" . $event->tarea->id . "/" . $paso . "/" . rawurlencode($hojaNombre);
                        $link = [
                                            "mime" => "application/msword",
                                            "url" => $url,
                                        ];
                        \App\Http\Controllers\FolderController::saveLink('tareas', $filename, $link);
                        $path = Storage::disk('tareas')->getDriver()->getAdapter()->applyPathPrefix($filename);
                        \App\ToPDF::toPDF(env('APP_URL') . $url, substr($path, 0, -4) . 'pdf');
                    }
                }
            }
        }
    }
}
