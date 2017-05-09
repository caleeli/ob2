<?php
namespace App\Models\Captura;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Capture extends Model
{
    use SoftDeletes;
    protected $table = 'exc_captures';
    protected $fillable = array(
      0 => 'name',
      1 => 'part_of',
      2 => 'file',
    );
    protected $attributes = array(
      'name' => null,
      'part_of' => null,
      'file' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'part_of' => 'string',
      'file' => 'array',
    );
    public function sheets()
    {
        return $this->hasMany('App\Models\Captura\Sheet');
    }
}
