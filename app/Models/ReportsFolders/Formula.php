<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Formula extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'be_formulas';
    protected $fillable = array(
      0 => 'formula',
      1 => 'origin_id',
      2 => 'target_id',
    );
    protected $attributes = array(
      'formula' => null,
    );
    protected $casts = array(
      'formula' => 'string',
    );
    protected $events = array(
    );
    public function origin()
    {
        return $this->belongsTo('App\Models\ReportsFolders\Unit');
    }


    public function target()
    {
        return $this->belongsTo('App\Models\ReportsFolders\Unit');
    }
}
