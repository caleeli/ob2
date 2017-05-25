<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Family extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'be_families';
    protected $fillable = array(
      0 => 'name',
      1 => 'main_unit',
    );
    protected $attributes = array(
      'name' => null,
      'main_unit' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'main_unit' => 'string',
    );
    protected $events = array(
    );
    public function dimensions()
    {
        return $this->hasMany('App\Models\ReportsFolders\Dimension');
    }
}
