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
      1 => 'titular_uai',
      2 => 'estructura_uai',
      3 => 'empresa_id',
    );
    protected $attributes = array(
      'cod_uai' => '',
      'titular_uai' => '',
      'estructura_uai' => '',
    );
    protected $casts = array(
      'cod_uai' => 'string',
      'titular_uai' => 'string',
      'estructura_uai' => 'string',
    );
    protected $events = array(
    );
    public function empresa()
    {
        return $this->belongsTo('App\Models\UserAdministration\Empresa');
    }
}
