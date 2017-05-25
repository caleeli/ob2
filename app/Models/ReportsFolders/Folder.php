<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Folder extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'be_folders';
    protected $fillable = array(
      0 => 'name',
      1 => 'type',
      2 => 'folder_id',
    );
    protected $attributes = array(
      'name' => null,
      'type' => 'FOLDER',
    );
    protected $casts = array(
      'name' => 'string',
      'type' => 'string',
    );
    protected $events = array(
    );
    public function folder()
    {
        return $this->belongsTo('App\Models\ReportsFolders\Folder');
    }


    public function children()
    {
        return $this->hasMany('App\Models\ReportsFolders\Folder');
    }


    public function reports()
    {
        return $this->hasMany('App\Models\ReportsFolders\Report');
    }
}
