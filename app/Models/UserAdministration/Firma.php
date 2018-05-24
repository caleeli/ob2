<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;

class Firma extends Model
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'adm_evaluacion_consistencias';
    protected $fillable = array(
      0 => 'cod_firma',
      1 => 'documento_firma',
      2 => 'informes',
      3 => 'informe_dictamen',
      4 => 'representante_legal',
      5 => 'gestion',
      6 => 'detalle',
      7 => 'empresa_id',
      8 => 'owner_id',
    );
    protected $attributes = array(
      'cod_firma' => '',
      'documento_firma' => null,
      'informes' => null,
      'informe_dictamen' => null,
      'representante_legal' => '',
      'gestion' => '',
      'detalle' => '',
    );
    protected $casts = array(
      'cod_firma' => 'string',
      'documento_firma' => 'array',
      'informes' => 'array',
      'informe_dictamen' => 'array',
      'representante_legal' => 'string',
      'gestion' => 'string',
      'detalle' => 'string',
    );
    protected $events = array(
    );
    public function empresa()
    {
        return $this->belongsTo('App\Models\UserAdministration\Empresa');
    }


    public function owner()
    {
        return $this->belongsTo('App\Models\UserAdministration\User');
    }
}
