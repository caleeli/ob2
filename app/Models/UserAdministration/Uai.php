<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Uai extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'adm_uais';
    protected $fillable = array(
      0 => 'cod_uai',
      1 => 'gestion_uai',
      2 => 'estructura_uai',
      3 => 'titular_uai',
      4 => 'tipo_de_informes',
      5 => 'informes_emitidos_scep',
      6 => 'empresa_id',
      7 => 'owner_id',
    );
    protected $attributes = array(
      'cod_uai' => '',
      'gestion_uai' => '',
      'estructura_uai' => '',
      'titular_uai' => '',
      'tipo_de_informes' => null,
      'informes_emitidos_scep' => null,
    );
    protected $casts = array(
      'cod_uai' => 'string',
      'gestion_uai' => 'string',
      'estructura_uai' => 'string',
      'titular_uai' => 'string',
      'tipo_de_informes' => 'array',
      'informes_emitidos_scep' => 'array',
    );
    protected $events = array(
    );
    public function empresa()
    {
        return $this->belongsTo('App\Models\UserAdministration\Empresa', 'empresa_id', 'cod_empresa');
    }


    public function owner()
    {
        return $this->belongsTo('App\Models\UserAdministration\User');
    }
}
