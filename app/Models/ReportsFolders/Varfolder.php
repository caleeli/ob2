<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Varfolder extends Model
{
    use SoftDeletes;
    protected $table = 'repfol_varfolders';
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
    public function folder()
    {
        return $this->belongsTo('App\Models\ReportsFolders\Varfolder');
    }


    public function children()
    {
        return $this->hasMany('App\Models\ReportsFolders\Varfolder');
    }


    public function variables()
    {
        return $this->hasMany('App\Models\ReportsFolders\Variable');
    }
}
