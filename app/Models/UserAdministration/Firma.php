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
      4 => 'gestion',
      5 => 'detalle',
      6 => 'empresa_id',
      7 => 'representante_legal_id',
      8 => 'owner_id',
      9 => 'supervisor_id',
    );
    protected $attributes = array(
      'cod_firma' => '',
      'documento_firma' => null,
      'informes' => null,
      'informe_dictamen' => null,
      'gestion' => '',
      'detalle' => '',
    );
    protected $casts = array(
      'cod_firma' => 'string',
      'documento_firma' => 'array',
      'informes' => 'array',
      'informe_dictamen' => 'array',
      'gestion' => 'string',
      'detalle' => 'string',
    );
    protected $events = array(
    );
    public function empresa()
    {
        return $this->belongsTo('App\Models\UserAdministration\Empresa');
    }


    public function representante_legal()
    {
        return $this->belongsTo('App\Models\UserAdministration\Lafirma');
    }


    public function owner()
    {
        return $this->belongsTo('App\Models\UserAdministration\User');
    }


    public function supervisor()
    {
        return $this->belongsTo('App\Models\UserAdministration\User');
    }


    public function procedencias()
    {
        $sql = "select nombre_empresa as nombre from adm_empresas
                                union
                                select nombre_empresa as nombre from adm_firmas";
        $res = \DB::select($sql);
        return ["data"=>$res];
    }
}
