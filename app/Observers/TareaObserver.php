<?php

namespace App\Observers;

use App\Models\UserAdministration\Tarea;

class TareaObserver
{
    public function saving(Tarea $tarea)
    {
        $avance = $tarea->calcEstado();
        \Log::debug('avance ' . $avance);
        $tarea->estado = $avance >= 100 ? 'Completado' : 'Pendiente';
        \Log::debug('estado ' . $tarea->estado);
    }
}
