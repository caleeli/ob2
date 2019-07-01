<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;

class Documento extends Model
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'adm_documentos';
    protected $fillable = array(
      0 => 'nombre',
      1 => 'archivo',
    );
    protected $attributes = array(
      'nombre' => null,
      'archivo' => null,
    );
    protected $casts = array(
      'nombre' => 'string',
      'archivo' => 'array',
    );
    protected $events = array(
    );
}
