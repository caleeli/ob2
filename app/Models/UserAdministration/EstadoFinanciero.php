<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;

class EstadoFinanciero extends Model
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'adm_estado_financieros';
    protected $fillable = array(
      0 => 'tipo_estado_financiero',
      1 => 'informes_auditoria',
      2 => 'gestion',
      3 => 'archivo',
      4 => 'grafico_texto',
      5 => 'prefix',
      6 => 'tablas',
      7 => 'grafico_valores',
      8 => 'empresa_id',
    );
    protected $attributes = array(
      'tipo_estado_financiero' => '',
      'informes_auditoria' => '',
      'gestion' => '',
      'archivo' => null,
      'grafico_texto' => 'activo,pasivo',
      'prefix' => null,
      'tablas' => null,
      'grafico_valores' => '4500,4000',
    );
    protected $casts = array(
      'tipo_estado_financiero' => 'string',
      'informes_auditoria' => 'string',
      'gestion' => 'string',
      'archivo' => 'array',
      'grafico_texto' => 'string',
      'prefix' => 'string',
      'tablas' => 'array',
      'grafico_valores' => 'string',
    );
    protected $events = array(
      'saving' => 'App\\Events\\UserAdministration\\EstadoFinancieroSaving',
    );
    public function empresa()
    {
        return $this->belongsTo('App\Models\UserAdministration\Empresa');
    }
}
