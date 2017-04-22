<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variable extends Model
{
    use SoftDeletes;
    protected $table = 'be_variables';
    protected $fillable = array(
      0 => 'name',
      1 => 'description',
      2 => 'image',
      3 => 'aggregator',
      4 => 'rows',
      5 => 'cols',
      6 => 'filter',
    );
    protected $attributes = array(
      'name' => null,
      'description' => null,
      'image' => null,
      'aggregator' => null,
      'rows' => null,
      'cols' => null,
      'filter' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'description' => 'string',
      'image' => 'string',
      'aggregator' => 'string',
      'rows' => 'string',
      'cols' => 'string',
      'filter' => 'string',
    );
    public function dimensions()
    {
        return $this->belongsToMany('App\Models\ReportsFolders\Dimension');
    }


    public function variableTags()
    {
        return $this->belongsToMany('App\Models\ReportsFolders\VariableTag');
    }
}
