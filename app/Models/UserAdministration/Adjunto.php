<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Adjunto extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'adm_adjuntos';
    protected $fillable = array(
      0 => 'archivo',
      1 => 'tarea_id',
    );
    protected $attributes = array(
      'archivo' => null,
    );
    protected $casts = array(
      'archivo' => 'array',
    );
    protected $events = array(
    );
    public function tarea()
    {
        return $this->belongsTo('App\Models\UserAdministration\Tarea');
    }
}
