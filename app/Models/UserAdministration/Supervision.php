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
    protected $fillable = array(
      0 => 'cod_supervision',
      1 => 'documento',
      2 => 'informes',
      3 => 'anexos',
      4 => 'nota_emitida',
      5 => 'gestion',
      6 => 'detalle',
      7 => 'empresa_id',
      8 => 'owner_id',
      9 => 'owner2_id',
      10 => 'supervisor_id',
    );
    protected $attributes = array(
      'cod_supervision' => '',
      'documento' => null,
      'informes' => null,
      'anexos' => null,
      'nota_emitida' => null,
      'gestion' => '',
      'detalle' => '',
    );
    protected $casts = array(
      'cod_supervision' => 'string',
      'documento' => 'array',
      'informes' => 'array',
      'anexos' => 'array',
      'nota_emitida' => 'array',
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


    public function owner2()
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
