<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;


class Uai extends Model
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'adm_uais';
    protected $fillable = array (
      0 => 'cod_uai',
      1 => 'gestion_uai',
      2 => 'estructura_uai',
      3 => 'tipo_de_informes',
      4 => 'informes_emitidos_scep',
      5 => 'empresa_id',
      6 => 'owner_id',
    );
    protected $attributes = array (
      'cod_uai' => '',
      'gestion_uai' => '',
      'estructura_uai' => '',
      'tipo_de_informes' => '',
      'informes_emitidos_scep' => NULL,
    );
    protected $casts = array (
      'cod_uai' => 'string',
      'gestion_uai' => 'string',
      'estructura_uai' => 'string',
      'tipo_de_informes' => 'string',
      'informes_emitidos_scep' => 'array',
    );
    protected $events = array (
    );
    public function empresa()
    {
        return $this->belongsTo('App\Models\UserAdministration\Empresa','empresa_id','cod_empresa');
    }


    public function owner()
    {
        return $this->belongsTo('App\Models\UserAdministration\User');
    }

}