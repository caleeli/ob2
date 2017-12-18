<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Rchart extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'be_rcharts';
    protected $fillable = array(
      0 => 'name',
      1 => 'description',
      2 => 'image2',
      3 => 'r_code',
    );
    protected $attributes = array(
      'name' => null,
      'description' => null,
      'image2' => null,
      'r_code' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'description' => 'string',
      'image2' => 'array',
      'r_code' => 'string',
    );
    protected $events = array(
    );
    public function variableTags()
    {
        return $this->belongsToMany('App\Models\ReportsFolders\VariableTag');
    }
}
