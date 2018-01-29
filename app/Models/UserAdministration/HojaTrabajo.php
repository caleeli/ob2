<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class HojaTrabajo extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'adm_hoja_trabajos';
    protected $fillable = array(
      0 => 'titulo',
      1 => 'contenido',
    );
    protected $attributes = array(
      'titulo' => '',
      'contenido' => '',
    );
    protected $casts = array(
      'titulo' => 'string',
      'contenido' => 'string',
    );
    protected $events = array(
    );
}
