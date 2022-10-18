<?php

namespace App\Observers;

use App\Models\UserAdministration\Tarea;

class TareaObserver
{
    public function saving(Tarea $tarea)
    {
        $avance = $tarea->calcEstado();
        $tarea->estado = $avance >= 100 ? 'Completado' : 'Pendiente';
    }
}
