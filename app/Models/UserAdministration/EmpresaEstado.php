<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;


class EmpresaEstado extends Model
{

    protected $table = 'adm_empresa_estados';
    protected $fillable = array (
      0 => 'nombre_empresa',
      1 => 'gestion',
    );
    protected $attributes = array (
      'nombre_empresa' => '',
      'gestion' => '',
    );
    protected $casts = array (
      'nombre_empresa' => 'string',
      'gestion' => 'string',
    );
    protected $events = array (
    );
    public function estados()
    {
        return $this->hasMany('App\Models\UserAdministration\EstadoFinanciero', 'empresa_id', 'empresa_id')->where('gestion', '=', $this->gestion);
    }

}