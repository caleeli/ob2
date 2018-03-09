<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;

class EmpresaGrafico extends Model
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'adm_empresa_graficos';
    protected $fillable = array(
      0 => 'titulo',
      1 => 'tipo',
      2 => 'informes_auditoria',
      3 => 'datos',
      4 => 'empresa_id',
    );
    protected $attributes = array(
      'titulo' => '',
      'tipo' => '',
      'informes_auditoria' => '',
      'datos' => null,
    );
    protected $casts = array(
      'titulo' => 'string',
      'tipo' => 'string',
      'informes_auditoria' => 'string',
      'datos' => 'array',
    );
    protected $events = array(
    );
    public function empresa()
    {
        return $this->belongsTo('App\Models\UserAdministration\Empresa');
    }
}
