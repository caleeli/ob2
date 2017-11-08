<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CuadroFinanciero extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'adm_cuadro_financieros';
    protected $fillable = array(
      0 => 'titulo',
      1 => 'contenido',
      2 => 'grafico',
    );
    protected $attributes = array(
      'titulo' => '',
      'contenido' => '',
      'grafico' => '',
    );
    protected $casts = array(
      'titulo' => 'string',
      'contenido' => 'string',
      'grafico' => 'string',
    );
    protected $events = array(
    );
    public function calculate($empresaId, $gestion, $html, $grafico='{}')
    {
        $ev = new \App\Evaluator($empresaId, $gestion);
        return [$ev->calculate($html), $ev->calculate($grafico, true)];
    }
}
