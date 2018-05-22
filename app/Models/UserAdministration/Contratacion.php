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
      2 => 'informe_dictamen',
      3 => 'nota',
      4 => 'empresa_id',
      5 => 'owner_id',
    );
    protected $attributes = array(
      'cod_firma' => '',
      'gestion' => '',
      'informe_dictamen' => null,
      'nota' => null,
    );
    protected $casts = array(
      'cod_firma' => 'string',
      'gestion' => 'string',
      'informe_dictamen' => 'array',
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
