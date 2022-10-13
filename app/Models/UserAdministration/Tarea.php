<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;


class Tarea extends Model
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'adm_tareas';
    protected $fillable = array (
      0 => 'cod_tarea',
      1 => 'nombre_tarea',
      2 => 'descripcion',
      3 => 'fecha_ini',
      4 => 'fecha_fin',
      5 => 'estado',
      6 => 'avance',
      7 => 'prioridad',
      8 => 'dias_otorgados',
      9 => 'nro_de_control',
      10 => 'gestion',
      11 => 'tipo',
      12 => 'datos',
      13 => 'creador_id',
      14 => 'revisor1_id',
      15 => 'aprobacion1_id',
      16 => 'revisor2_id',
      17 => 'aprobacion2_id',
    );
    protected $attributes = array (
      'cod_tarea' => '',
      'nombre_tarea' => '',
      'descripcion' => '',
      'fecha_ini' => '',
      'fecha_fin' => '',
      'estado' => 'Pendiente',
      'avance' => '0',
      'prioridad' => 'Media',
      'dias_otorgados' => '0',
      'nro_de_control' => NULL,
      'gestion' => NULL,
      'tipo' => NULL,
      'datos' => NULL,
    );
    protected $casts = array (
      'cod_tarea' => 'string',
      'nombre_tarea' => 'string',
      'descripcion' => 'string',
      'fecha_ini' => 'string',
      'fecha_fin' => 'string',
      'estado' => 'string',
      'avance' => 'integer',
      'prioridad' => 'string',
      'dias_otorgados' => 'integer',
      'nro_de_control' => 'string',
      'gestion' => 'string',
      'tipo' => 'string',
      'datos' => 'array',
    );
    protected $events = array (
      'saved' => 'App\\Events\\UserAdministration\\TareaSaved',
    );
    protected $appends = array (
      0 => 'dias_pasados',
      1 => 'ultima_asignacion',
    );
    public function usuarios()
    {
        return $this->belongsToMany('App\Models\UserAdministration\User');
    }


    public function creador()
    {
        return $this->belongsTo('App\Models\UserAdministration\User');
    }


    public function revisor1()
    {
        return $this->belongsTo('App\Models\UserAdministration\User');
    }


    public function aprobacion1()
    {
        return $this->belongsTo('App\Models\UserAdministration\User');
    }


    public function revisor2()
    {
        return $this->belongsTo('App\Models\UserAdministration\User');
    }


    public function aprobacion2()
    {
        return $this->belongsTo('App\Models\UserAdministration\User');
    }


    public function adjuntos()
    {
        return $this->hasMany('App\Models\UserAdministration\Adjunto');
    }


    public function avances()
    {
        return $this->hasMany('App\Models\UserAdministration\Avance');
    }


    public function asignaciones()
    {
        return $this->hasMany('App\Models\UserAdministration\Asignacion');
    }


    public function enlaces()
    {
        return $this->belongsToMany('App\Models\UserAdministration\Tarea', 'enlace_tarea', 'tarea_id', 'enlace_tarea_id');
    }


    function scopeWhereUserAssigned ($query, $userId, $ownerId) {
                            return $query->whereIn('id', function($query) use($userId, $ownerId) {
                                $query->select('tarea_id')
                                ->from('tarea_user')
                                ->where(function ($query) use($userId, $ownerId) {
                                    if ($ownerId!='1') {
                                        $query->where('user_id', $userId)
                                            ->orWhere('creador_id', $ownerId);
                                    }
                                });
                            });
                        }

    function getDiasPasadosAttribute () {
                            return $this->created_at->diff(\Carbon\Carbon::now())->days;
                        }

    function getDiasOtorgadosAttribute () {
                            $asignacion = $this->asignaciones()->orderBy('created_at', 'desc')->first();
                            return $asignacion ? $asignacion->dias_plazo * 1 : 0;
                        }

    function getAvanceAttribute () {
                            $avancesPorPersona = [];
                            $lastAsignation = $this->asignaciones()->max('nro_asignacion');
                            $avances = $this->avances()->with('asignacion')->orderBy('id', 'asc')->get();
                            foreach ($avances as $avance) {
                                if ($avance->asignacion && $avance->asignacion->nro_asignacion==$lastAsignation) {
                                    $avancesPorPersona[$avance->usuario_abm_id] = $avance->avance;
                                }
                            }
                            $total = array_sum($avancesPorPersona);
                            $count = $this->asignaciones()->where('nro_asignacion', $lastAsignation)->count();
                            return $count> 0 ? $total / $count : 0;
                        }

    function getUltimaAsignacionAttribute () {
                            $asignaciones = $this->asignaciones()->orderBy('id', 'desc')->get();
                            $ultimos = [];
                            $first = false;
                            foreach($asignaciones as $asignacion)
                            {
                                $first = $first ?: $asignacion->nro_asignacion;
                                if ($first==$asignacion->nro_asignacion) {
                                    $ultimos[$asignacion->user_id]=$asignacion->id;
                                }
                            }
                            return $ultimos;
                        }
}
