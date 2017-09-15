<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Empresa extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'adm_empresas';
    protected $fillable = array(
      0 => 'cod_empresa',
      1 => 'nombre_empresa',
      2 => 'corporacion',
      3 => 'caracter',
      4 => 'rubro',
      5 => 'tipologia',
      6 => 'detalle_empresa',
    );
    protected $attributes = array(
      'cod_empresa' => '',
      'nombre_empresa' => '',
      'corporacion' => '',
      'caracter' => '',
      'rubro' => '',
      'tipologia' => '',
      'detalle_empresa' => '',
    );
    protected $casts = array(
      'cod_empresa' => 'string',
      'nombre_empresa' => 'string',
      'corporacion' => 'string',
      'caracter' => 'string',
      'rubro' => 'string',
      'tipologia' => 'string',
      'detalle_empresa' => 'string',
    );
    protected $events = array(
    );
    public function estados()
    {
        return $this->hasMany('App\Models\UserAdministration\EstadoFinanciero');
    }


    public function prueba($nombre)
    {
        return "Hola $nombre";
    }
}
