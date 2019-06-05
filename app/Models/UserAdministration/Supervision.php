<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;


class Supervision extends Model
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'adm_supervisiones';
    protected $fillable = array (
      0 => 'cod_supervision',
      1 => 'documento',
      2 => 'informes',
      3 => 'informe_dictamen',
      4 => 'gestion',
      5 => 'detalle',
      6 => 'empresa_id',
      7 => 'representante_legal_id',
      8 => 'owner_id',
      9 => 'supervisor_id',
    );
    protected $attributes = array (
      'cod_supervision' => '',
      'documento' => NULL,
      'informes' => NULL,
      'informe_dictamen' => NULL,
      'gestion' => '',
      'detalle' => '',
    );
    protected $casts = array (
      'cod_supervision' => 'string',
      'documento' => 'array',
      'informes' => 'array',
      'informe_dictamen' => 'array',
      'gestion' => 'string',
      'detalle' => 'string',
    );
    protected $events = array (
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


    function procedencias () {
                            $sql = "select nombre_empresa as nombre from adm_empresas
                                union
                                select nombre_empresa as nombre from adm_firmas";
                            $res = \DB::select($sql);
                            return ["data"=>$res];
                        }
}