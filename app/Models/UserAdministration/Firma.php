<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Firma extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'adm_firmas';
    protected $fillable = array(
      0 => 'cod_firma',
      1 => 'gestion',
      2 => 'detalle',
      3 => 'representante_legal',
      4 => 'informe_dictamen',
      5 => 'vigencia_certificado',
      6 => 'documento_firma',
      7 => 'empresa_id',
      8 => 'owner_id',
    );
    protected $attributes = array(
      'cod_firma' => '',
      'gestion' => '',
      'detalle' => '',
      'representante_legal' => '',
      'informe_dictamen' => null,
      'vigencia_certificado' => '',
      'documento_firma' => null,
    );
    protected $casts = array(
      'cod_firma' => 'string',
      'gestion' => 'string',
      'detalle' => 'string',
      'representante_legal' => 'string',
      'informe_dictamen' => 'array',
      'vigencia_certificado' => 'string',
      'documento_firma' => 'array',
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
