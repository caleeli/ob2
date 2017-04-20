<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dimension extends Model
{
    use SoftDeletes;
    protected $table = 'be_dimensions';
    protected $fillable = array(
      0 => 'name',
      1 => 'column',
      2 => 'family_id',
    );
    protected $attributes = array(
      'name' => null,
      'column' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'column' => 'string',
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
