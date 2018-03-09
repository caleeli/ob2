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
      1 => 'gestion',
      2 => 'detalle',
      3 => 'representante_legal',
      4 => 'informe_dictamen',
      5 => 'vigencia_certificado',
      6 => 'documento_firma',
      7 => 'informes',
      8 => 'empresa_id',
      9 => 'owner_id',
    );
    protected $attributes = array(
      'cod_firma' => '',
      'gestion' => '',
      'detalle' => '',
      'representante_legal' => '',
      'informe_dictamen' => null,
      'vigencia_certificado' => '',
      'documento_firma' => null,
      'informes' => null,
    );
    protected $casts = array(
      'cod_firma' => 'string',
      'gestion' => 'string',
      'detalle' => 'string',
      'representante_legal' => 'string',
      'informe_dictamen' => 'array',
      'vigencia_certificado' => 'string',
      'documento_firma' => 'array',
      'informes' => 'array',
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
