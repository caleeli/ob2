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
      7 => 'sub_empresa',
      8 => 'es_principal',
    );
    protected $attributes = array(
      'cod_empresa' => '',
      'nombre_empresa' => '',
      'corporacion' => '',
      'caracter' => '',
      'rubro' => '',
      'tipologia' => '',
      'detalle_empresa' => '',
      'sub_empresa' => '0',
      'es_principal' => '0',
    );
    protected $casts = array(
      'cod_empresa' => 'string',
      'nombre_empresa' => 'string',
      'corporacion' => 'string',
      'caracter' => 'string',
      'rubro' => 'string',
      'tipologia' => 'string',
      'detalle_empresa' => 'string',
      'sub_empresa' => 'string',
      'es_principal' => 'string',
    );
    protected $events = array(
    );
    public function estados()
    {
        return $this->hasMany('App\Models\UserAdministration\EstadoFinanciero');
    }


    public function graficos()
    {
        return $this->hasMany('App\Models\UserAdministration\EmpresaGrafico');
    }


    public function getDetalleEmpresaAttribute($value)
    {
        $ev = new \App\Evaluator($this->id, date('Y') - 1);
        return $ev->calculate($value);
    }

    public function eeff($gestion, $eeff)
    {
        $ev = new \App\Evaluator($this->id, $gestion);
        $res = [];
        foreach ($eeff as $key => $val) {
            $isChart = substr($key, 0, 5) === 'chart';
            $cal = @$ev->calculate($val, $isChart);
            if ($isChart) {
                $res[$key] = json_decode($cal);
            } else {
                $res[$key] = $cal;
            }
        }
        return $res;
    }
}
