<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Dimension extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'be_dimensions';
    protected $fillable = array(
      0 => 'name',
      1 => 'column',
      2 => 'arbitrary',
      3 => 'numeric',
      4 => 'family_id',
    );
    protected $attributes = array(
      'name' => null,
      'column' => null,
      'arbitrary' => 'no',
      'numeric' => 'no',
    );
    protected $casts = array(
      'name' => 'string',
      'column' => 'string',
      'arbitrary' => 'string',
      'numeric' => 'string',
    );
    protected $events = array(
    );
    public function family()
    {
        return $this->belongsTo('App\Models\ReportsFolders\Family');
    }


    public function domains()
    {
        return $this->hasMany('App\Models\ReportsFolders\Domain');
    }


    public function variables()
    {
        return $this->belongsToMany('App\Models\ReportsFolders\Variable');
    }
}
