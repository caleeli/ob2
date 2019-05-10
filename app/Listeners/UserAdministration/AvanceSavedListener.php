<?php
namespace App\Listeners\UserAdministration;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\UserAdministration\Avance;
use App\Events\UserAdministration\AvanceSaved;


class AvanceSavedListener
{

    public $avance = NULL;
public function handle (AvanceSaved $event) {
                        if (!$event->avance->tarea_id) {
                            return;
                        }
                        $event->avance->tarea->avance = $event->avance->tarea->getAvanceAttribute();
                        $event->avance->tarea->save();
                    }
}