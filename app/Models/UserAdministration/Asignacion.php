<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;

class Asignacion extends Model
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'tarea_user';
    protected $fillable = array(
      0 => 'tarea_id',
      1 => 'user_id',
      2 => 'nro_asignacion',
      3 => 'tipo',
      4 => 'dias_plazo',
    );
    protected $attributes = array(
      'tarea_id' => null,
      'user_id' => null,
      'nro_asignacion' => null,
      'tipo' => null,
      'dias_plazo' => null,
    );
    protected $casts = array(
      'tarea_id' => 'int',
      'user_id' => 'int',
      'nro_asignacion' => 'int',
      'tipo' => 'string',
      'dias_plazo' => 'int',
    );
    protected $events = array(
    );
    public function avances()
    {
        return $this->hasMany('App\Models\UserAdministration\Avance');
    }
}
