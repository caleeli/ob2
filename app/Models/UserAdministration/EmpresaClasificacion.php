<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;

class EmpresaClasificacion extends Model
{
    protected $table = 'adm_empresa_clasificacions';
    protected $fillable = array(
      0 => 'clasificacion',
      1 => 'conteo',
    );
    protected $attributes = array(
      'clasificacion' => '',
      'conteo' => '',
    );
    protected $casts = array(
      'clasificacion' => 'string',
      'conteo' => 'string',
    );
    protected $events = array(
    );
}
