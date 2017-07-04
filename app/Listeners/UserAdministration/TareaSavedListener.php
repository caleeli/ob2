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
    }
}
