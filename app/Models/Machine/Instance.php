<?php
namespace App\Models\Machine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instance extends Model
{
    use SoftDeletes;
    protected $table = 'undefined_instances';
    protected $fillable = array(
      0 => 'status',
    );
    protected $attributes = array(
      'status' => 'ACTIVE',
    );
    protected $casts = array(
      'status' => 'string',
    );
    public function tokens()
    {
        return $this->hasMany('App\Models\Machine\Token');
    }


    public function process()
    {
        return $this->belongsTo('App\Models\Machine\Process');
    }


    public function evaluate($expression)
    {
    }
}
