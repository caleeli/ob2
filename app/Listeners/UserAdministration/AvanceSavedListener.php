<?php
namespace App\Listeners\UserAdministration;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\UserAdministration\Avance;
use App\Events\UserAdministration\AvanceSaved;

class AvanceSavedListener
{
    public $avance = null;
    public function handle(AvanceSaved $event)
    {
        if (!$event->avance->tarea_id) {
            return;
        }
        if ($event->avance->avance==100) {
            $event->avance->tarea->estado = 'Completado';
        }
        $event->avance->tarea->avance = $event->avance->avance;
        $event->avance->tarea->save();
    }
}
