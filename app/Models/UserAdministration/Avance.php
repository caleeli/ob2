<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;


class Avance extends Model
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'adm_avances';
    protected $fillable = array (
      0 => 'avance',
      1 => 'descripcion',
      2 => 'tarea_id',
      3 => 'usuario_id',
      4 => 'asignacion_id',
    );
    protected $attributes = array (
      'avance' => NULL,
      'descripcion' => NULL,
    );
    protected $casts = array (
      'avance' => 'integer',
      'descripcion' => 'string',
    );
    protected $events = array (
      'saved' => 'App\\Events\\UserAdministration\\AvanceSaved',
    );
    protected $appends = array (
      0 => 'avance_relativo',
    );
    public function tarea()
    {
        return $this->belongsTo('App\Models\UserAdministration\Tarea');
    }


    public function usuario()
    {
        return $this->belongsTo('App\Models\UserAdministration\User','usuario_abm_id','id');
    }


    public function asignacion()
    {
        return $this->belongsTo('App\Models\UserAdministration\Asignacion');
    }


    function getAvanceRelativoAttribute () {
                        if (!$this->asignacion) return 0;
                        $nro_asignacion = $this->asignacion->nro_asignacion;
                        $count = $this->tarea->asignaciones()
                            ->where('nro_asignacion', $nro_asignacion)->count();
                        return $count> 0 ? $this->avance / $count : 0;
                    }
}