<?php
namespace App\Models\Machine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Element extends Model
{
    use SoftDeletes;
    protected $table = 'undefined_elements';
    protected $fillable = array(
      0 => 'name',
      1 => 'type',
      2 => 'script',
    );
    protected $attributes = array(
      'name' => '',
      'type' => 'ACTIVITY',
      'script' => '',
    );
    protected $casts = array(
      'name' => 'string',
      'type' => 'string',
      'script' => 'string',
    );
    public function incomings()
    {
        return $this->belongsToMany('App\Models\Machine\Activity');
    }


    public function outgoings()
    {
        return $this->belongsToMany('App\Models\Machine\Activity');
    }


    public function nextElements($instance)
    {
        foreach ($this->outgoings() as $out) {
            if ($instance->evaluate($out->contidion)) {
                $out->first()->tokens()->create([
                                'instance_id'=>$instance->id,
                            ]);
            }
        }
    }
}
