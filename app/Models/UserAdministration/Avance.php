<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;

class Avance extends Model
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'adm_avances';
    protected $fillable = array(
      0 => 'avance',
      1 => 'descripcion',
      2 => 'tarea_id',
    );
    protected $attributes = array(
      'avance' => null,
      'descripcion' => null,
    );
    protected $casts = array(
      'avance' => 'integer',
      'descripcion' => 'string',
    );
    protected $events = array(
      'saved' => 'App\\Events\\UserAdministration\\AvanceSaved',
    );
    public function tarea()
    {
        return $this->belongsTo('App\Models\UserAdministration\Tarea');
    }
}
