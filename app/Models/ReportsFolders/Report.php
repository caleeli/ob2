<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
    protected $table = 'repfol_reports';
    protected $fillable = array(
      0 => 'name',
      1 => 'table',
      2 => 'aggregator',
      3 => 'measure',
      4 => 'rows',
      5 => 'cols',
      6 => 'folder_id',
    );
    protected $attributes = array(
      'name' => null,
      'table' => null,
      'aggregator' => null,
      'measure' => 'valor',
      'rows' => null,
      'cols' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'table' => 'string',
      'aggregator' => 'string',
      'measure' => 'string',
      'rows' => 'string',
      'cols' => 'string',
    );
    public function folder()
    {
        return $this->belongsTo('App\Models\ReportsFolders\Folder');
    }


    public function variables()
    {
        return $this->hasMany('App\Models\ReportsFolders\Variable');
    }


    public function dashboard1($t=0)
    {
        $res = ['x'=>[],'series'=>['reportes'=>[]]];
        $rep = \DB::select("select (select repfol_folders.name from repfol_folders where repfol_folders.id=repfol_reports.folder_id) name, count(*) count from repfol_reports group by folder_id");
        foreach ($rep as $row) {
            $res['x'][] = $row->name;
            $res['series']['reportes'][] = $row->count;
        }
        return $res;
    }
                    

    public function tablas($conn=null)
    {
        $collection = [];
        $tables = \DB::select("show tables");
        $type = 'tables';
        foreach ($tables as $table) {
            foreach ($table as $name) {
                $collection[] = [
                                    'type'          => $type,
                                    'id'            => $name,
                                    'attributes'    => ['name'=>$name],
                                    'relationships' => [],
                                ];
            }
        }
        return ['data'=>$collection];
    }
                    

    public function columnas($tabla='ejemplo')
    {
        $collection = [];
        $columns = \Schema::getColumnListing($tabla);
        $type = 'columns';
        foreach ($columns as $name) {
            $collection[] = [
                                'type'          => $type,
                                'id'            => $name,
                                'attributes'    => ['name'=>$name],
                                'relationships' => [],
                            ];
        }
        return ['data'=>$collection];
    }
}
