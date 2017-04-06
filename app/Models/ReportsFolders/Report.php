<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
    protected $table = 'be_reports';
    protected $fillable = array(
      0 => 'name',
      1 => 'variables',
      2 => 'aggregator',
      3 => 'rows',
      4 => 'cols',
      5 => 'filter',
      6 => 'folder_id',
    );
    protected $attributes = array(
      'name' => null,
      'variables' => null,
      'aggregator' => null,
      'rows' => null,
      'cols' => null,
      'filter' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'variables' => 'string',
      'aggregator' => 'string',
      'rows' => 'string',
      'cols' => 'string',
      'filter' => 'string',
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
        $rep = \DB::select("select (select be_folders.name from be_folders where be_folders.id=be_reports.folder_id) as name, count(*) as count from be_reports group by folder_id");
        foreach ($rep as $row) {
            $res['x'][] = $row->name;
            $res['series']['reportes'][] = $row->count;
        }
        return $res;
    }
                    

    public function tablas($conn=null)
    {
        $collection = [];
        $tables = \DB::connection("datos")->getDoctrineSchemaManager()->listTableNames();
        $type = 'tables';
        foreach ($tables as $name) {
            $collection[] = [
                                'type'          => $type,
                                'id'            => $name,
                                'attributes'    => ['name'=>$name],
                                'relationships' => [],
                            ];
        }
        return ['data'=>$collection];
    }
                    

    public function columnas($tabla='ejemplo')
    {
        $collection = [];
        $columns = \DB::connection("datos")->getSchemaBuilder()->getColumnListing($tabla);
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
                    

    public function dimensiones($variables='')
    {
        $collection = [];
        $variableRows = \App\Models\ReportsFolders\Variable::whereIn(
                            'id',
                            explode('', $variables)
                        );
        $dims = [];
        foreach ($variableRows as $var) {
            foreach ($var->dimensions() as $dim) {
                $dims[$dim->id] = $dim;
            }
        }
        $type = 'ReportsFolders.Dimension';
        foreach ($dims as $dim) {
            $collection[] = [
                                'type'          => $type,
                                'id'            => $dim->id,
                                'attributes'    => ['name'=>$dim->name],
                                'relationships' => [],
                            ];
        }
        return ['data'=>$collection];
    }
}
