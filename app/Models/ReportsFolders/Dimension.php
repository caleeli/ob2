<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dimension extends Model
{
    use SoftDeletes;
    protected $table = 'repfol_dimensions';
    protected $fillable = array(
      0 => 'name',
    );
    protected $attributes = array(
      'name' => null,
    );
    protected $casts = array(
      'name' => 'string',
    );
    public function domains()
    {
        return $this->hasMany('App\Models\ReportsFolders\Domain');
    }
}
