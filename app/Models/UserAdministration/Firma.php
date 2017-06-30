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
      3 => 'tipo_firma',
      4 => 'representante_legal',
      5 => 'socios',
      6 => 'vigencia_certificado',
      7 => 'documento_firma',
      8 => 'empresa_id',
    );
    protected $attributes = array(
      'cod_firma' => '',
      'gestion' => '',
      'detalle' => '',
      'tipo_firma' => '',
      'representante_legal' => '',
      'socios' => '',
      'vigencia_certificado' => '',
      'documento_firma' => null,
    );
    protected $casts = array(
      'cod_firma' => 'string',
      'gestion' => 'string',
      'detalle' => 'string',
      'tipo_firma' => 'string',
      'representante_legal' => 'string',
      'socios' => 'string',
      'vigencia_certificado' => 'string',
      'documento_firma' => 'array',
    );
    protected $events = array(
    );
    public function empresa()
    {
        return $this->belongsTo('App\Models\UserAdministration\Empresa');
    }
}
