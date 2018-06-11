<?php
namespace App\Listeners\UserAdministration;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\UserAdministration\Tarea;
use App\Events\UserAdministration\TareaSaved;

class TareaSavedListener
{
    public $tarea = null;
    public function handle($event)
    {
        if (!$event->tarea->cod_tarea) {
            $event->tarea->cod_tarea = "SCEP-" . $event->tarea->id;
            $event->tarea->save();
        }
        $paso = 3;
        if (!empty($event->tarea->datos['data'][$paso]['hojaTrabajo'])) {
            $hoja = $event->tarea->datos['data'][$paso]['hojaTrabajo'];
            $titulo = $hoja['titulo'];
            $filename = $event->tarea->id . '/' . ($paso + 1) . '/' . $titulo . '.link';
            $link = [
                                "mime" => "application/msword",
                                "url" => "/vue-editor/download/" . $hoja['templeta'] . "/" . $event->tarea->id . "/" . $paso,
                            ];
            \App\Http\Controllers\FolderController::saveLink('tareas', $filename, $link);
        }
    }
}
