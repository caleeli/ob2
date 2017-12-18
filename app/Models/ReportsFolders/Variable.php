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
      3 => 'image2',
      4 => 'aggregator',
      5 => 'rows',
      6 => 'cols',
      7 => 'estado',
      8 => 'filter',
      9 => 'information_source',
      10 => 'file',
      11 => 'periodicity',
      12 => 'source_link',
      13 => 'chart_type',
    );
    protected $attributes = array(
      'name' => null,
      'description' => null,
      'image' => null,
      'image2' => null,
      'aggregator' => null,
      'rows' => null,
      'cols' => null,
      'estado' => 'Pública',
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
      'image2' => 'array',
      'aggregator' => 'string',
      'rows' => 'string',
      'cols' => 'string',
      'estado' => 'string',
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
