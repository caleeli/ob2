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
      1 => 'informe_scep',
      2 => 'nota',
      3 => 'gestion',
      4 => 'empresa_id',
      5 => 'owner_id',
    );
    protected $attributes = array(
      'cod_firma' => '',
      'informe_scep' => null,
      'nota' => null,
      'gestion' => '',
    );
    protected $casts = array(
      'cod_firma' => 'string',
      'informe_scep' => 'array',
      'nota' => 'array',
      'gestion' => 'string',
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
