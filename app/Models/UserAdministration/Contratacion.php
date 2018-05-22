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
      3 => 'informe_dictamen',
      4 => 'vigencia_certificado',
      5 => 'nota',
      6 => 'empresa_id',
      7 => 'owner_id',
    );
    protected $attributes = array(
      'cod_firma' => '',
      'gestion' => '',
      'detalle' => '',
      'informe_dictamen' => null,
      'vigencia_certificado' => '',
      'nota' => null,
    );
    protected $casts = array(
      'cod_firma' => 'string',
      'gestion' => 'string',
      'detalle' => 'string',
      'informe_dictamen' => 'array',
      'vigencia_certificado' => 'string',
      'nota' => 'array',
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
