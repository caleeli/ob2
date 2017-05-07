<?php
namespace App\Models\Captura;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sheet extends Model
{
    use SoftDeletes;
    protected $table = 'exc_sheets';
    protected $fillable = array(
      0 => 'name',
      1 => 'rows',
      2 => 'cols',
      3 => 'to_load',
      4 => 'load_order',
      5 => 'process',
      6 => 'capture_id',
    );
    protected $attributes = array(
      'name' => null,
      'rows' => null,
      'cols' => null,
      'to_load' => null,
      'load_order' => null,
      'process' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'rows' => 'string',
      'cols' => 'string',
      'to_load' => 'string',
      'load_order' => 'integer',
      'process' => 'string',
    );
    public function capture()
    {
        return $this->belongsTo('App\Models\Captura\Capture');
    }
}
