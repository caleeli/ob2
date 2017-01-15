<?php
namespace App\Models\Machine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Token extends Model
{
    use SoftDeletes;
    protected $table = 'undefined_tokens';
    protected $fillable = array(
      0 => 'status',
    );
    protected $attributes = array(
      'status' => 'ACTIVE',
    );
    protected $casts = array(
      'status' => 'string',
    );
    public function instance()
    {
        return $this->belongsTo('App\Models\Machine\Instance');
    }


    public function element()
    {
        return $this->belongsTo('App\Models\Machine\Element');
    }


    public function done()
    {
        $this->status='DONE';
        $this->save();
        $this->element()->nextElements($this->instance());
    }
}
