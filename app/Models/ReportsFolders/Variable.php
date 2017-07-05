<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Variable extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'be_variables';
    protected $fillable = array(
      0 => 'name',
      1 => 'description',
      2 => 'image',
      3 => 'aggregator',
      4 => 'rows',
      5 => 'cols',
      6 => 'filter',
      7 => 'information_source',
      8 => 'file',
      9 => 'periodicity',
      10 => 'source_link',
      11 => 'chart_type',
    );
    protected $attributes = array(
      'name' => null,
      'description' => null,
      'image' => null,
      'aggregator' => null,
      'rows' => null,
      'cols' => null,
      'filter' => null,
      'information_source' => null,
      'file' => null,
      'periodicity' => null,
      'source_link' => null,
      'chart_type' => 'line',
    );
    protected $casts = array(
      'name' => 'string',
      'description' => 'string',
      'image' => 'string',
      'aggregator' => 'string',
      'rows' => 'string',
      'cols' => 'string',
      'filter' => 'string',
      'information_source' => 'string',
      'file' => 'array',
      'periodicity' => 'string',
      'source_link' => 'string',
      'chart_type' => 'string',
    );
    protected $events = array(
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
