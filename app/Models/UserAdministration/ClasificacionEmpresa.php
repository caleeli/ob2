<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;


class ClasificacionEmpresa extends Model
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'adm_clasificacion_empresas';
    protected $fillable = array (
      0 => 'clasificacion',
      1 => 'conteo',
    );
    protected $attributes = array (
      'clasificacion' => '',
      'conteo' => '',
    );
    protected $casts = array (
      'clasificacion' => 'string',
      'conteo' => 'string',
    );
    protected $events = array (
    );

}