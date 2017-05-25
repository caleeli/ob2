<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Domain extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'be_domains';
    protected $fillable = array(
      0 => 'name',
      1 => 'synonyms',
      2 => 'dimension_id',
    );
    protected $attributes = array(
      'name' => null,
      'synonyms' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'synonyms' => 'string',
    );
    protected $events = array(
    );
    public function dimension()
    {
        return $this->belongsTo('App\Models\ReportsFolders\Dimension');
    }
}
