<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Unit extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'be_units';
    protected $fillable = array(
      0 => 'name',
      1 => 'family_id',
    );
    protected $attributes = array(
      'name' => null,
    );
    protected $casts = array(
      'name' => 'string',
    );
    protected $events = array(
    );
    public function family()
    {
        return $this->belongsTo('App\Models\ReportsFolders\Family');
    }
}
