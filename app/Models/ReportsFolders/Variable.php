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
    );
    protected $attributes = array(
      'name' => null,
      'description' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'description' => 'string',
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
