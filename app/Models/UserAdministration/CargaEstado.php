<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CargaEstado extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'adm_carga_estados';
    protected $fillable = array(
      0 => 'files',
    );
    protected $attributes = array(
      'files' => null,
    );
    protected $casts = array(
      'files' => 'array',
    );
    protected $events = array(
      'saving' => 'App\\Events\\UserAdministration\\CargaEstadoSaving',
    );
}
