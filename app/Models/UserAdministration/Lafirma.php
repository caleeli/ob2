<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;

class Lafirma extends Model
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'adm_firmas';
    protected $fillable = array(
      0 => 'cod_firma',
      1 => 'nombre_empresa',
    );
    protected $attributes = array(
      'cod_firma' => '',
      'nombre_empresa' => '',
    );
    protected $casts = array(
      'cod_firma' => 'string',
      'nombre_empresa' => 'string',
    );
    protected $events = array(
    );
}
