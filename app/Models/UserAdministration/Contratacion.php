<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;

class Contratacion extends Model
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'contrataciones';
    protected $fillable = array(
      0 => 'cod_firma',
      1 => 'gestion',
      2 => 'detalle',
      3 => 'representante_legal',
      4 => 'informe_dictamen',
      5 => 'vigencia_certificado',
      6 => 'nota',
      7 => 'usuario_abm_id',
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
      'nota' => null,
      'usuario_abm_id' => null,
    );
    protected $casts = array(
      'cod_firma' => 'string',
      'gestion' => 'string',
      'detalle' => 'string',
      'representante_legal' => 'string',
      'informe_dictamen' => 'array',
      'vigencia_certificado' => 'string',
      'nota' => 'array',
      'usuario_abm_id' => 'integer',
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
