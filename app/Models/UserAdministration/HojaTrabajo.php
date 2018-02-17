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
      1 => 'templeta',
      2 => 'gestion',
      3 => 'valores',
    );
    protected $attributes = array(
      'titulo' => '',
      'templeta' => '',
      'gestion' => '',
      'valores' => '{}',
    );
    protected $casts = array(
      'titulo' => 'string',
      'templeta' => 'string',
      'gestion' => 'string',
      'valores' => 'array',
    );
    protected $events = array(
    );
}
