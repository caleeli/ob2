<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Tarea extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'adm_tareas';
    protected $fillable = array(
      0 => 'cod_tarea',
      1 => 'nombre_tarea',
      2 => 'descripcion',
      3 => 'fecha_ini',
      4 => 'fecha_fin',
      5 => 'estado',
      6 => 'avance',
      7 => 'prioridad',
      8 => 'usuario_id',
      9 => 'creador_id',
      10 => 'revisor1_id',
      11 => 'aprobacion1_id',
      12 => 'revisor2_id',
      13 => 'aprobacion2_id',
    );
    protected $attributes = array(
      'cod_tarea' => '',
      'nombre_tarea' => '',
      'descripcion' => '',
      'fecha_ini' => '',
      'fecha_fin' => '',
      'estado' => 'Pendiente',
      'avance' => '0',
      'prioridad' => 'Media',
    );
    protected $casts = array(
      'cod_tarea' => 'string',
      'nombre_tarea' => 'string',
      'descripcion' => 'string',
      'fecha_ini' => 'string',
      'fecha_fin' => 'string',
      'estado' => 'string',
      'avance' => 'integer',
      'prioridad' => 'string',
    );
    protected $events = array(
      'saved' => 'App\\Events\\UserAdministration\\TareaSaved',
    );
    public function usuario()
    {
        return $this->belongsTo('App\Models\UserAdministration\User');
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
}
